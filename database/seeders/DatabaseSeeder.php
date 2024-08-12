<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Menu;
use App\Models\User;
use Database\Factories\CustomerFactory;
use Database\Factories\RevenueFactory;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            'email' => 'p7I8Z@example.com',
            'password' => Hash::make('kasir123'),
            'role' => 'kasir',
            'username' => 'kasir',
        ]);
    }
}
