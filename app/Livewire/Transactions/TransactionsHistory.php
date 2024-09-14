<?php

namespace App\Livewire\Transactions;

use App\Exports\TransactionsExport;
use App\Models\Revenue;
use App\Models\Transaction;
use Livewire\Attributes\Title;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class TransactionsHistory extends Component
{
    #[Title('Transactions History')]
    public $search = '';
    public $startDate;
    public $endDate;
    public $date;
    public $filterDate;
    public $startDateRevenue;
    public $endDateRevenue;

    public function export()
    {
        if ($this->startDate && $this->endDate) {
            return Excel::download(new TransactionsExport($this->startDate, $this->endDate), 'transactions_report.xlsx');
        }
        return false;
    }
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
        $totalRevenueToday = Revenue::whereDate('date', now())->sum('revenue');
        $totalRevenueThisMonth = Revenue::whereMonth('date', now())->sum('revenue');
        $totalTransactionThisMonth = Transaction::whereMonth('created_at', now()->month)->count();
        $totalTransactionsToday = Transaction::whereDate('created_at', now())->count();

        $transactionsQuery = Transaction::with('customer')
            ->search($this->search)
            ->latest();

        if ($this->filterDate) {
            $transactionsQuery->whereDate('created_at', $this->filterDate);
        }

        $transactions = $transactionsQuery->paginate(10)->withQueryString();

        return view('livewire.transactions.transactions-history', compact('transactions', 'totalTransactionsToday', 'totalTransactionThisMonth', 'totalRevenueToday', 'totalRevenueThisMonth'));
    }
}