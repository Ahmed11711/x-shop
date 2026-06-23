<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionGroupsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('permission_groups')->insert([
            [
                'name' => 'Dashboard',
                'label' => 'Dashboard',
                'is_active' => 1,
            ],
            [
                'name' => 'POS',
                'label' => 'Point Of Sale',
                'is_active' => 1,
            ],
            [
                'name' => 'Sales',
                'label' => 'Sales',
                'is_active' => 1,
            ],
            [
                'name' => 'Purchases',
                'label' => 'Purchases',
                'is_active' => 1,
            ],
            [
                'name' => 'Products',
                'label' => 'Products',
                'is_active' => 1,
            ],
            [
                'name' => 'Categories',
                'label' => 'Categories',
                'is_active' => 1,
            ],
            [
                'name' => 'Inventory',
                'label' => 'Inventory',
                'is_active' => 1,
            ],
            [
                'name' => 'Customers',
                'label' => 'Customers',
                'is_active' => 1,
            ],
            [
                'name' => 'Suppliers',
                'label' => 'Suppliers',
                'is_active' => 1,
            ],
            [
                'name' => 'Users',
                'label' => 'Users',
                'is_active' => 10,
            ],
            [
                'name' => 'Roles',
                'label' => 'Roles & Permissions',
                'is_active' => 11,
            ],
            [
                'name' => 'Reports',
                'label' => 'Reports',
                'is_active' => 12,
            ],
            [
                'name' => 'Settings',
                'label' => 'Settings',
                'is_active' => 13,
            ],
        ]);
    }
}
