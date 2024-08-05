<?php

namespace App\Livewire\Dashboard;

use App\Models\Customer;
use App\Models\Menu;
use App\Models\Revenue;
use App\Models\Transaction;
use Carbon\Carbon;
use Livewire\Component;

class StatsComponent extends Component
{
    public $totalCustomersToday;
    public $totalRevenueToday;
    public $totalRevenueThisMonth;
    public $totalTransactionThisMonth;

    public function mount()
    {
        $today = Carbon::today();

        // Jumlah transaksi bulan ini
        $this->totalTransactionThisMonth = Transaction::whereMonth('created_at', $today->month)->count();

        // Total pendapatan bulan ini
        $this->totalRevenueThisMonth = Revenue::whereMonth('date', $today->month)->sum('revenue');

        // Jumlah pelanggan hari ini
        $this->totalCustomersToday = Customer::whereDate('created_at', $today)->count();

        // Total pendapatan hari ini
        $this->totalRevenueToday = Revenue::whereDate('date', $today)->sum('revenue');
    }

    public function render()
    {
        return view('livewire.stats-component');
    }
}
