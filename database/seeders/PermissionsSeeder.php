<?php

namespace Database\Seeders;

use App\Models\PermissionGroup;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsSeeder extends Seeder
{
    public function run(): void
    {
        $groups = PermissionGroup::pluck('id', 'name');

        $permissions = [

            // Dashboard
            ['permission_group_id' => $groups['Dashboard'], 'name' => 'dashboard.view', 'label' => 'View Dashboard'],

            // POS
            ['permission_group_id' => $groups['POS'], 'name' => 'pos.view', 'label' => 'View POS'],
            ['permission_group_id' => $groups['POS'], 'name' => 'pos.create_sale', 'label' => 'Create Sale'],
            ['permission_group_id' => $groups['POS'], 'name' => 'pos.refund', 'label' => 'Refund Sale'],

            // Products
            ['permission_group_id' => $groups['Products'], 'name' => 'products.view', 'label' => 'View Products'],
            ['permission_group_id' => $groups['Products'], 'name' => 'products.create', 'label' => 'Create Product'],
            ['permission_group_id' => $groups['Products'], 'name' => 'products.update', 'label' => 'Update Product'],
            ['permission_group_id' => $groups['Products'], 'name' => 'products.delete', 'label' => 'Delete Product'],

            // Categories
            ['permission_group_id' => $groups['Categories'], 'name' => 'categories.view', 'label' => 'View Categories'],
            ['permission_group_id' => $groups['Categories'], 'name' => 'categories.create', 'label' => 'Create Category'],
            ['permission_group_id' => $groups['Categories'], 'name' => 'categories.update', 'label' => 'Update Category'],
            ['permission_group_id' => $groups['Categories'], 'name' => 'categories.delete', 'label' => 'Delete Category'],

            // Inventory
            ['permission_group_id' => $groups['Inventory'], 'name' => 'inventory.view', 'label' => 'View Inventory'],
            ['permission_group_id' => $groups['Inventory'], 'name' => 'inventory.adjust', 'label' => 'Adjust Inventory'],

            // Sales
            ['permission_group_id' => $groups['Sales'], 'name' => 'sales.view', 'label' => 'View Sales'],
            ['permission_group_id' => $groups['Sales'], 'name' => 'sales.create', 'label' => 'Create Sale'],
            ['permission_group_id' => $groups['Sales'], 'name' => 'sales.cancel', 'label' => 'Cancel Sale'],

            // Purchases
            ['permission_group_id' => $groups['Purchases'], 'name' => 'purchases.view', 'label' => 'View Purchases'],
            ['permission_group_id' => $groups['Purchases'], 'name' => 'purchases.create', 'label' => 'Create Purchase'],

            // Customers
            ['permission_group_id' => $groups['Customers'], 'name' => 'customers.view', 'label' => 'View Customers'],
            ['permission_group_id' => $groups['Customers'], 'name' => 'customers.create', 'label' => 'Create Customer'],
            ['permission_group_id' => $groups['Customers'], 'name' => 'customers.update', 'label' => 'Update Customer'],
            ['permission_group_id' => $groups['Customers'], 'name' => 'customers.delete', 'label' => 'Delete Customer'],

            // Suppliers
            ['permission_group_id' => $groups['Suppliers'], 'name' => 'suppliers.view', 'label' => 'View Suppliers'],
            ['permission_group_id' => $groups['Suppliers'], 'name' => 'suppliers.create', 'label' => 'Create Supplier'],
            ['permission_group_id' => $groups['Suppliers'], 'name' => 'suppliers.update', 'label' => 'Update Supplier'],
            ['permission_group_id' => $groups['Suppliers'], 'name' => 'suppliers.delete', 'label' => 'Delete Supplier'],

            // Users
            ['permission_group_id' => $groups['Users'], 'name' => 'users.view', 'label' => 'View Users'],
            ['permission_group_id' => $groups['Users'], 'name' => 'users.create', 'label' => 'Create User'],
            ['permission_group_id' => $groups['Users'], 'name' => 'users.update', 'label' => 'Update User'],
            ['permission_group_id' => $groups['Users'], 'name' => 'users.delete', 'label' => 'Delete User'],

            // Roles
            ['permission_group_id' => $groups['Roles'], 'name' => 'roles.view', 'label' => 'View Roles'],
            ['permission_group_id' => $groups['Roles'], 'name' => 'roles.create', 'label' => 'Create Role'],
            ['permission_group_id' => $groups['Roles'], 'name' => 'roles.update', 'label' => 'Update Role'],
            ['permission_group_id' => $groups['Roles'], 'name' => 'roles.delete', 'label' => 'Delete Role'],
            ['permission_group_id' => $groups['Roles'], 'name' => 'permissions.manage', 'label' => 'Manage Permissions'],

            // Reports
            ['permission_group_id' => $groups['Reports'], 'name' => 'reports.view', 'label' => 'View Reports'],
            ['permission_group_id' => $groups['Reports'], 'name' => 'reports.export', 'label' => 'Export Reports'],

            // Settings
            ['permission_group_id' => $groups['Settings'], 'name' => 'settings.view', 'label' => 'View Settings'],
            ['permission_group_id' => $groups['Settings'], 'name' => 'settings.update', 'label' => 'Update Settings'],
        ];

        foreach ($permissions as &$permission) {
            $permission['is_active'] = true;
            $permission['created_at'] = now();
            $permission['updated_at'] = now();
        }

        DB::table('permissions')->insert($permissions);
    }
}
