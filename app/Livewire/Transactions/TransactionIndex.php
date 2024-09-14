<?php

namespace App\Livewire\Transactions;

use App\Models\Menu;
use App\Models\Revenue;
use Livewire\Component;
use App\Models\Customer;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Livewire\Attributes\Title;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Midtrans\Snap;

class TransactionIndex extends Component
{
    #[Title('Transaksi')]
    #[Layout('layouts.cashier')]
    public $snapToken;
    public $isCheckoutDisabled = true;
    public $items = [];
    public $customer_id;
    public $totalPrice = 0;
    public $description;
    public $searchMenu = '';
    public $search = '';
    public $selectedCustomerId;
    public $customers = [];
    public $payment_method = '';
    public $invoice_number;
    public $customers_pay;
    public $change;



    public function resetForm()
    {
        $this->items = [];
        $this->customer_id = null;
        $this->selectedCustomerId = null;
        $this->totalPrice = 0;
        $this->description = null;
        $this->payment_method = '';
        $this->customers_pay = null;
        $this->change = null;
        $this->searchMenu = '';
        $this->search = '';
    }
    public function updated($propertyName)
    {
        $this->validateInput();
    }

    public function validateInput()
    {
        $this->isCheckoutDisabled = empty($this->selectedCustomerId) && empty($this->items);
    }

    public function updatedSearch()
    {
        if (!empty($this->search)) {
            $this->customers = Customer::where('name', 'like', '%' . $this->search . '%')->get();
        } else {
            $this->customers = [];
        }
    }

    public function selectCustomer($customerId)
    {
        $this->selectedCustomerId = $customerId;
        $this->customers = [];
        $this->search = Customer::findOrFail($customerId)->name;
    }

    public function resetCustomer()
    {
        $this->selectedCustomerId = null;
        $this->search = '';
        $this->customers = [];
    }
    public function mount()
    {
        $this->calculateTotalPrice();
    }

    public function setPaymentMethod($method)
    {
        $this->payment_method = $method;
        if ($method === 'qris') {
            $this->customers_pay = null;
            $this->change = null;
        }
    }
    public function incrementQty($key)
    {
        if (isset($this->items[$key])) {
            $menu = Menu::where('name', $key)->first();
            $this->items[$key]['qty']++;
            $this->items[$key]['price'] = $menu->price;
            $this->items[$key]['amount'] = $menu->price * $this->items[$key]['qty'];
            $this->calculateTotalPrice();
        }
    }


    public function updatedCustomersPay($value)
    {
        if ($this->payment_method === 'cash') {
            $this->change = currencyIDRtoNumeric($this->customers_pay) - $this->totalPrice;
        }
    }



    public function updateChange()
    {
        if ($this->payment_method === 'cash') {
            $this->change = currencyIDRtoNumeric($this->customers_pay) - $this->totalPrice;
        }
    }


    public function addItem(Menu $menu)
    {
        if (isset($this->items[$menu->name])) {
            $this->items[$menu->name]['qty']++;
            $this->items[$menu->name]['price'] = $menu->price;
            $this->items[$menu->name]['amount'] = $menu->price * $this->items[$menu->name]['qty'];
        } else {
            $this->items[$menu->name] = [
                'qty' => 1,
                'amount' => $menu->price,
                'price' => $menu->price
            ];
        }
        $this->calculateTotalPrice();
    }

    public function removeItem($key)
    {
        if (isset($this->items[$key])) {
            if ($this->items[$key]['qty'] > 1) {
                $menu = Menu::where('name', $key)->first();
                $this->items[$key]['qty']--;
                $this->items[$key]['amount'] = $menu->price * $this->items[$key]['qty'];
            } else {
                unset($this->items[$key]);
            }
        }
        $this->calculateTotalPrice();
    }


    public function calculateTotalPrice()
    {
        $this->totalPrice = array_sum(array_column($this->items, 'amount'));
    }

    public function store()
    {
        $transaction = Transaction::create([
            'items' => $this->items,
            'customer_id' => $this->customer_id = $this->selectedCustomerId,
            'total' => $this->totalPrice,
            'description' => $this->description,
            'payment_method' => $this->payment_method,
            'customers_pay' => currencyIDRtoNumeric($this->customers_pay),
            'change' => currencyIDRtoNumeric($this->change),
            'invoice_number' => $this->invoice_number = 'INV' . now()->format('YmdHis')  . Str::random(6),
            'user_id' => Auth::user()->id
        ]);

        Revenue::create([
            'revenue' => $this->totalPrice,
            'date' => date('Y-m-d')
        ]);

        $cust = Customer::find($this->selectedCustomerId);

        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = config('midtrans.is_production');
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => $this->invoice_number,
                'gross_amount' => $this->totalPrice,
                'date' => date('Y-m-d'),
            ),
            'customer_details' => array(
                'first_name' => $cust->name
            )
        );

        $snapToken = Snap::getSnapToken($params);
        $this->snapToken = $snapToken;
        $transaction->snap_token = $this->snapToken;
        $transaction->status = 'success';
        $transaction->save();
        $this->resetForm();
        $this->calculateTotalPrice();
        return redirect()->route('transactions.pay', $transaction->invoice_number);
    }
    public function generateInvoicePDF($transactionId)
    {
        $transaction = Transaction::findOrFail($transactionId);

        $pdf = Pdf::loadView('invoices.invoice-pdf', ['transaction' => $transaction])
            ->setPaper([0, 0, 400, 400], 'portrait');
        return $pdf->stream('invoice-' . $transaction->invoice_number . '.pdf');
    }

    protected $listeners = ['snapToken' => 'store'];
    public function render(Transaction $transaction)
    {
        $menus = Menu::with('category')->search($this->searchMenu)->get()->groupBy(function ($menu) {
            return $menu->category->name;
        });
        return view('livewire.transactions.transaction-index', [
            'menus' => $menus,
            'transaction' => $transaction,
            'snapToken' => $this->snapToken,
        ]);
    }
}