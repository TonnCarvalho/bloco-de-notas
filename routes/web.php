<?php

use App\Http\Middleware\IsLogin;
use App\Http\Middleware\NotLogin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\Auth\AuthController;

// Auth
Route::middleware([IsLogin::class])->group(function () {
    Route::get('/login', [AuthController::class, 'login'])
        ->name('login');
    Route::post('/login', [AuthController::class, 'submit'])
        ->name('loginSubmit');
});

Route::middleware([NotLogin::class])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])
        ->name('logout');

    Route::controller(MainController::class)->group(function () {
        Route::get('/', 'index')
            ->name('main');
        Route::get('/nova-nota', 'novaNota')
            ->name('novaNota');
    });
});
