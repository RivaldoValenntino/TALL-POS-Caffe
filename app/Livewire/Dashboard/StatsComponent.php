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
    public $totalRevenueAllTime;
    public $totalTransactionThisDay;
    public $totalCustomersThisMonth;

    public function mount()
    {
        $today = Carbon::today();


        // Jumlah pelanggan bulan ini
        $this->totalCustomersThisMonth = Transaction::whereMonth('created_at', $today->month)->count();

        // Jumlah pendapatan keseluruhan
        $this->totalRevenueAllTime = Revenue::sum('revenue');

        // Jumlah transaksi hari ini
        $this->totalTransactionThisDay = Transaction::whereDate('created_at', $today)->count();

        // Jumlah transaksi bulan ini
        $this->totalTransactionThisMonth = Transaction::whereMonth('created_at', $today->month)->count();

        // Total pendapatan bulan ini
        $this->totalRevenueThisMonth = Revenue::whereMonth('date', $today->month)->sum('revenue');

        $this->totalCustomersToday = Customer::whereDate('created_at', $today)->count();
        // Jumlah pelanggan hari ini

        // Total pendapatan hari ini
        $this->totalRevenueToday = Revenue::whereDate('date', $today)->sum('revenue');
    }

    public function render()
    {
        return view('livewire.stats-component');
    }
}
