<?php

namespace App\Exports;

use App\Models\Revenue;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithTitle;

class RevenueExport implements FromView, WithTitle, WithColumnWidths
{


    protected $startDateRevenue;
    protected $endDateRevenue;

    public function __construct($startDateRevenue, $endDateRevenue)
    {
        $this->startDateRevenue = $startDateRevenue;
        $this->endDateRevenue = $endDateRevenue;
    }

    public function view(): View
    {
        $revenues = Revenue::whereBetween('date', [$this->startDateRevenue, $this->endDateRevenue])
            ->orderBy('date', 'asc')
            ->get();
        return view('exports.revenues', compact('revenues'));
    }
    public function title(): string
    {
        return 'Revenue Report';
    }


    public function columnWidths(): array
    {
        return [
            'A' => 30,
            'B' => 30,
        ];
    }
}