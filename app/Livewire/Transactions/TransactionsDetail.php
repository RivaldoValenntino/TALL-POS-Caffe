<?php

namespace App\Livewire\Transactions;

use App\Models\Transaction;
use Barryvdh\DomPDF\Facade\Pdf;
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
    public function generateInvoicePDF($transactionId)
    {
        $transaction = Transaction::findOrFail($transactionId);

        $pdf = Pdf::loadView('invoices.invoice-pdf', ['transaction' => $transaction])
            ->setPaper('a4', 'portrait');

        return $pdf->stream('invoice-' . $transaction->invoice_number . '.pdf');
    }

    public function render()
    {
        return view('livewire.transactions.transactions-detail');
    }
}
