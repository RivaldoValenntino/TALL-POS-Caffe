<?php

namespace App\Livewire\Transactions;

use App\Models\Transaction;
use Livewire\Attributes\Title;
use Livewire\Component;

class TransactionsDetail extends Component
{

    #[Title('Detail Transaksi')]
    public $transaction;

    public function mount($invoice_number)
    {
        $this->transaction = Transaction::with('customer')->where('invoice_number', $invoice_number)->first();
    }
    public function render()
    {
        return view('livewire.transactions.transactions-detail');
    }
}
