<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Branch\BranchController;
use App\Http\Controllers\Admin\RolePermission\RolePermissionController;
use App\Http\Controllers\Admin\PermissionGroup\PermissionGroupController;
use App\Http\Controllers\Admin\Role\RoleController;


use App\Http\Controllers\Admin\User\UserController;
use App\Http\Controllers\Tenant\TenantMigrationController;
use App\Http\Middleware\ResolveTenant;


Route::prefix('v1/admin')->middleware(ResolveTenant::class)->group(function () {
    Route::post('migrate', [TenantMigrationController::class, 'migrateCurrentTenant']);

    Route::apiResource('users', UserController::class)->names('user');
    Route::apiResource('roles', RoleController::class)->names('role');
    Route::apiResource('permission_groups', PermissionGroupController::class)->names('permission_group');
    Route::apiResource('role_permissions', RolePermissionController::class)->names('role_permission');
    Route::apiResource('branches', BranchController::class)->names('branch');
});

Route::prefix('v1')->group(function () {});
