<?php

namespace App\Livewire\Transactions;

use App\Models\Transaction;
use Livewire\Attributes\Title;
use Livewire\Component;

class TransactionsHistory extends Component
{
    #[Title('Transactions History')]
    public $search = '';


    public function delete($invNum)
    {
        $transaction = Transaction::where('invoice_number', $invNum)->first();
        $transaction->delete();
        toastr()->success('Transaction deleted successfully');
    }

    public function updateStatus($transactionId, $status)
    {
        $transaction = Transaction::findOrFail($transactionId);
        $transaction->update(['status' => $status]);
        toastr()->success('Transaction status updated successfully');
    }
    public function render()
    {
        $transactions = Transaction::with('customer')->search($this->search)->paginate(10)->withQueryString();
        return view('livewire.transactions.transactions-history', compact('transactions'));
    }
}
