<?php

namespace App\Livewire\Dashboard;

use App\Models\Customer;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ChartCustomer extends Component
{
    public $customersData;

    public function mount()
    {
        // Get revenue data query
        $customersData = Customer::select(
            DB::raw("strftime('%m', created_at) as month"),
            DB::raw('COUNT(id) as total_revenue')
        )
            ->groupBy(DB::raw("strftime('%m', created_at)"))
            ->orderBy(DB::raw("strftime('%m', created_at)"))
            ->get();

        // Format data
        $formattedData = $customersData->mapWithKeys(function ($item) {
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
        $this->customersData = array_map(function ($month) use ($formattedData) {
            return $formattedData[$month];
        }, $allMonths);

        // dd($this->customersData);
    }
    public function render()
    {
        return view('livewire.dashboard.chart-customer');
    }
}
