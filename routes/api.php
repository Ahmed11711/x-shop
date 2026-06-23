<?php

use App\Http\Controllers\Admin\User\UserController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\PaymentController;
use App\Http\Middleware\ResolveTenant;
use Illuminate\Support\Facades\Route;



Route::prefix('v1')->group(function () {
    Route::post('/register', [RegisterController::class, 'register']);
});
Route::prefix('v1/admin/')->middleware(ResolveTenant::class)->group(function () {
    Route::post('/auth/login', [LoginController::class, 'login']);
    Route::apiResource('users', UserController::class)->names('users');
});




Route::prefix('payments')->group(function () {
    Route::get('gateways', [PaymentController::class, 'gateways']);
    Route::post('charge',   [PaymentController::class, 'charge']);
    Route::post('refund',   [PaymentController::class, 'refund']);
});



require __DIR__ . '/admin.php';
require __DIR__ . '/superAdmin.php';
