<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;

// Auth
Route::get('/login', [AuthController::class, 'login'])
->name('login');
Route::post('/login', [AuthController::class, 'submit'])
->name('loginSubmit');
Route::get('/logout', [AuthController::class, 'logout'])
->name('logout');