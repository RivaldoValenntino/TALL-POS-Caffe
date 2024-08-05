<?php

namespace App\Livewire\Transactions;

use App\Models\Transaction;
use Livewire\Component;

class Invoice extends Component
{
    public $transaction;

    public function mount($invoice_number)
    {
        $this->transaction = Transaction::with('customer')->where('invoice_number', $invoice_number)->first();
    }
    public function render()
    {
        return view('livewire.transactions.invoice');
    }
}
