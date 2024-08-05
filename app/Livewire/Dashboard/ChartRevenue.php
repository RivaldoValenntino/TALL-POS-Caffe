<?php

namespace App\Livewire\Dashboard;

use App\Models\Revenue;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class ChartRevenue extends Component
{
    public $revenueData = [];


    public function mount()
    {
        // Get revenue data query
        $revenueData = Revenue::select(
            DB::raw("strftime('%m', date) as month"),
            DB::raw('SUM(revenue) as total_revenue')
        )
            ->groupBy(DB::raw("strftime('%m', date)"))
            ->orderBy(DB::raw("strftime('%m', date)"))
            ->get();

        // Format data
        $formattedData = $revenueData->mapWithKeys(function ($item) {
            $monthNumber = $item->month;
            $monthName = date('F', mktime(0, 0, 0, $monthNumber, 10)); // Get the name of the month
            return [$monthName => $item->total_revenue];
        })->toArray();

        // List Months
        $allMonths = [
            'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December'
        ];

        // If the month doesn't exist in the data, set it to 0
        foreach ($allMonths as $month) {
            if (!isset($formattedData[$month])) {
                $formattedData[$month] = 0;
            }
        }

        // Sort the data by month
        $this->revenueData = array_map(function ($month) use ($formattedData) {
            return $formattedData[$month];
        }, $allMonths);
    }

    public function render()
    {
        return view('livewire.dashboard.chart-revenue');
    }
}
