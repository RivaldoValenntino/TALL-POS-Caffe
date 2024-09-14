<?php

namespace App\Livewire;

use App\Models\Customer;
use App\Models\Menu;
use App\Models\Revenue;
use App\Models\Transaction;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Midtrans\Snap;

class TransactionCheckout extends Component
{
    public $transaction;
    public $invoice_number;

    public function mount($invoice_number)
    {
        $this->invoice_number = $invoice_number;
        $this->transaction = Transaction::where('invoice_number', $invoice_number)->first();
    }

    public function printInvoice()
    {
        $transaction = Transaction::where('invoice_number', $this->invoice_number)->first();

        $pdf = Pdf::loadView('invoices.invoice-pdf', ['transaction' => $transaction])
            ->setPaper([0, 0, 400, 400], 'portrait');

        return $pdf->stream('invoice-' . $transaction->invoice_number . '.pdf');
    }

    public function render()
    {
        return view('livewire.transaction-checkout');
    }
}