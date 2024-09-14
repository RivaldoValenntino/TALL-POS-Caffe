<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Menu;
use App\Models\User;
use Database\Factories\CustomerFactory;
use Database\Factories\RevenueFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Kasir',
            'password' => Hash::make('kasir123'),
            'role' => 'kasir',
            'username' => 'kasir2',
        ]);

        User::create([
            'name' => 'admin',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'username' => 'admin2'
        ]);
    }
}