<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('/refresh', [AuthController::class, 'refresh'])->name('refresh');
});

Route::group([
    'middleware' => 'jwt.auth',
    'prefix' => 'notification'
], function ($router) {
    Route::post('/email', [NotificationController::class, 'sendEmail']);

    Route::post('/sms', [NotificationController::class, 'sendSms']);
});
