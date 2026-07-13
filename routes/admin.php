<?php

use App\Http\Controllers\Admin\Branch\BranchController;
use App\Http\Controllers\Admin\Brand\BrandController;
use App\Http\Controllers\Admin\CategoryProduct\CategoryProductController;
use App\Http\Controllers\Admin\Contact\ContactController;
use App\Http\Controllers\Admin\CustomerGroup\CustomerGroupController;
use App\Http\Controllers\Admin\PermissionGroup\PermissionGroupController;
use App\Http\Controllers\Admin\Product\ProductController;

use App\Http\Controllers\Admin\ProductUnit\ProductUnitController;
use App\Http\Controllers\Admin\Role\RoleController;
use App\Http\Controllers\Admin\RolePermission\RolePermissionController;
use App\Http\Controllers\Admin\SellingPriceGroup\SellingPriceGroupController;
use App\Http\Controllers\Admin\User\UserController;
use App\Http\Controllers\Admin\UserRole\UserRoleController;
use App\Http\Controllers\Admin\Warranty\WarrantyController;


use App\Http\Controllers\ShopifyWebhookController;
use App\Http\Controllers\Tenant\TenantMigrationController;
use App\Http\Controllers\WooCommerceConnectController;
use App\Http\Controllers\WooCommerceWebhookController;
use App\Http\Middleware\ResolveTenant;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PurchaseReturn\PurchaseReturnController;
use App\Http\Controllers\Admin\Purchase\PurchaseController;
use App\Http\Controllers\Admin\suppliers\suppliersController;




Route::prefix('v1/admin')->middleware(ResolveTenant::class)->group(function () {
    Route::post('migrate', [TenantMigrationController::class, 'migrateCurrentTenant']);


    Route::apiResource('users', UserController::class)->names('user');
    Route::apiResource('roles', RoleController::class)->names('role');
    Route::apiResource('permission_groups', PermissionGroupController::class)->names('permission_group');
    Route::apiResource('role_permissions', RolePermissionController::class)->names('role_permission');
    Route::apiResource('branches', BranchController::class)->names('branch');
    Route::apiResource('user_roles', UserRoleController::class)->names('user_role');
    Route::apiResource('customer_groups', CustomerGroupController::class)->names('customer_group');
    Route::apiResource('contacts', ContactController::class)->names('contact');
    Route::apiResource('category_products', CategoryProductController::class)->names('category_product');
    Route::apiResource('unit_products', ProductUnitController::class)->names('product_unit');
    Route::apiResource('brands', BrandController::class)->names('brand');
    Route::apiResource('warranties', WarrantyController::class)->names('warranty');
    Route::apiResource('selling_price_groups', SellingPriceGroupController::class)->names('selling_price_group');
    Route::apiResource('products', ProductController::class)->names('product');
    Route::apiResource('suppliers', suppliersController::class)->names('suppliers');
    Route::apiResource('purchases', PurchaseController::class)->names('purchase');
    Route::apiResource('purchase_returns', PurchaseReturnController::class)->names('purchase_return');
});

// for Shopify webhooks and insert tenant name as domain to find the tenant and connect to its database
Route::post('/webhooks/shopify/{tenant_name}/product-create', [ShopifyWebhookController::class, 'handleProductCreate']);
Route::post('/webhooks/shopify/{tenant_name}/product-update', [ShopifyWebhookController::class, 'handleProductUpdate']);
Route::post('/webhooks/shopify/{tenant_name}/product-delete', [ShopifyWebhookController::class, 'handleProductDelete']);
Route::post('/webhooks/woocommerce/{tenant_name}/product-create', [WooCommerceWebhookController::class, 'handleProductCreate']);
Route::post('/webhooks/woocommerce/{tenant_name}/product-update', [WooCommerceWebhookController::class, 'handleProductUpdate']);
Route::post('/webhooks/woocommerce/{tenant_name}/product-delete', [WooCommerceWebhookController::class, 'handleProductDelete']);
Route::prefix('v1')->group(function () {});
Route::get('/connect-woocommerce', [WooCommerceConnectController::class, 'connect']);
