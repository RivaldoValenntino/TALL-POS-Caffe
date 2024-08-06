<?php

namespace App\Livewire\Transactions;

use App\Models\Menu;
use App\Models\Revenue;
use Livewire\Component;
use App\Models\Customer;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Livewire\Attributes\Title;

class TransactionIndex extends Component
{
    #[Title('Transaksi')]

    public $items = [];
    public $customer_id;
    public $totalPrice = 0;
    public $description;
    public $searchMenu = '';
    public $search = '';
    public $selectedCustomerId;
    public $customers = [];
    public $payment_method = '';
    public $customers_pay;
    public $change;

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
        Transaction::create([
            'items' => $this->items,
            'customer_id' => $this->customer_id = $this->selectedCustomerId,
            'total' => $this->totalPrice,
            'description' => $this->description,
            'payment_method' => $this->payment_method,
            'customers_pay' => currencyIDRtoNumeric($this->customers_pay),
            'change' => currencyIDRtoNumeric($this->change),
            'invoice_number' => 'INV' . now()->format('YmdHis')  . Str::random(6)
        ]);

        Revenue::create([
            'revenue' => $this->totalPrice,
            'date' => date('Y-m-d')
        ]);

        toastr()->success('Transaction saved successfully');

        $this->items = [];
        $this->customer_id = null;
        $this->selectedCustomerId = null;
        $this->totalPrice = 0;
        $this->description = null;
        $this->payment_method = '';
        $this->customers_pay = null;
        $this->change = null;

        $this->calculateTotalPrice();

        return redirect()->back();


        // dd($this->items, $this->customer_id = $this->selectedCustomerId, $this->totalPrice, $this->description, $this->payment_method,  currencyIDRtoNumeric($this->customers_pay), currencyIDRtoNumeric($this->change));
    }
    public function render()
    {
        $menus = Menu::with('category')->search($this->searchMenu)->get()->groupBy(function ($menu) {
            return $menu->category->name;
        });
        $transaksi = Transaction::all();
        return view('livewire.transactions.transaction-index', compact('menus', 'transaksi'));
    }
}