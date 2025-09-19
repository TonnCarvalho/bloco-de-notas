<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Middleware\IsLogin;

// Auth
Route::get('/login', [AuthController::class, 'login'])
    ->name('login');
Route::post('/login', [AuthController::class, 'submit'])
    ->name('loginSubmit');

Route::middleware([IsLogin::class])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])
        ->name('logout');

    Route::controller(MainController::class)->group(function () {
        Route::get('/', 'index')
            ->name('main');
        Route::get('/nova-nota', 'novaNota')
            ->name('novaNota');
    });
});
