<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('roles')->insert([
            [
                'name' => 'Super Admin',
                'description' => 'Full system access',
                'is_active' => true,
            ],
            [
                'name' => 'Admin',
                'description' => 'System administrator',
                'is_active' => true,
            ],
            [
                'name' => 'Manager',
                'description' => 'Branch manager',
                'is_active' => true,
            ],
            [
                'name' => 'Cashier',
                'description' => 'POS cashier',
                'is_active' => true,
            ],
            [
                'name' => 'Sales',
                'description' => 'Sales employee',
                'is_active' => true,
            ],
        ]);
    }
}
