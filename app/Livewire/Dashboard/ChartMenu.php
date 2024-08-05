<?php

namespace App\Livewire\Dashboard;

use App\Models\Menu;
use App\Models\Transaction;
use Livewire\Component;

class ChartMenu extends Component
{
    public $mostMenu;

    public function mount()
    {

        // Get All Transactions
        $transactions = Transaction::all();

        // Create an empty array to store menu counts
        $menuCounts = [];

        // Process each transaction
        foreach ($transactions as $transaction) {
            // Decode items from JSON
            $items = $transaction->items;

            // Process each item in the transaction
            foreach ($items as $itemName => $item) {
                if (!isset($menuCounts[$itemName])) {
                    $menuCounts[$itemName] = 0;
                }
                $menuCounts[$itemName] += $item['qty'];
            }
        }

        // Sort by menu count (descending)
        arsort($menuCounts);

        // Get top 5 menus
        $topMenus = array_slice($menuCounts, 0, 5, true);

        // Get most bought menu
        $this->mostMenu = Menu::whereIn('name', array_keys($topMenus))
            ->get()
            ->map(function ($menu) use ($topMenus) {
                $menu->total_bought = $topMenus[$menu->name];
                return $menu;
            });

        // dd($this->mostMenu);
    }
    public function render()
    {
        return view('livewire.dashboard.chart-menu');
    }
}
