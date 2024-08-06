<?php

namespace App\Livewire\Reports;

use App\Exports\RevenueExport;
use App\Exports\TransactionsExport;
use App\Models\Transaction;
use Livewire\Attributes\Title;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class ExcelReport extends Component
{
    #[Title('Excel Report')]
    public $startDate;
    public $endDate;
    public $date;
    public $startDateRevenue;
    public $endDateRevenue;

    public function export()
    {
        return Excel::download(new TransactionsExport($this->startDate, $this->endDate), 'transactions_report.xlsx');
    }
    public function exportRevenue()
    {
        return Excel::download(new RevenueExport($this->startDateRevenue, $this->endDateRevenue), 'revenues_report.xlsx');
    }

    public function render()
    {
        return view('livewire.reports.excel-report');
    }
}