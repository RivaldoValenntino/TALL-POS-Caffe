<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::create(['name' => 'admin']);
        $kasirRole = Role::create(['name' => 'kasir']);

        Permission::create(['name' => 'view dashboard']);
        Permission::create(['name' => 'view menu']);
        Permission::create(['name' => 'view categories']);
        Permission::create(['name' => 'view customers']);
        Permission::create(['name' => 'view orders']);
        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'view history']);
        Permission::create(['name' => 'view order details']);
        Permission::create(['name' => 'print invoice']);

        $adminRole->givePermissionTo(Permission::all());
        $kasirRole->givePermissionTo(['view orders']);
    }
}
