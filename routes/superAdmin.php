<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserPackage\UserPackageController;
use App\Http\Controllers\Admin\FeaturePackage\FeaturePackageController;
use App\Http\Controllers\Admin\Package\PackageController;
use App\Http\Controllers\Admin\User\UserController;

Route::prefix('v1/super_admin')->group(function () {
    // Route::apiResource('users', UserController::class);

    Route::apiResource('packages', PackageController::class)->names('package');
    Route::apiResource('feature_packages', FeaturePackageController::class)
        ->names('feature_package')
        ->middleware('sync.feature.package');
    Route::apiResource('user_packages', UserPackageController::class)->names('user_package');
});
