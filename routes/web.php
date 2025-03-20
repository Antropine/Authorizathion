<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Форма регистрации
Route::get('register', [UserController::class, 'create'])->name('register');

// Обработка регистрации
Route::post('register', [UserController::class, 'store'])->name('user.store');

Route::get('login', [UserController::class, 'login'])->name('login');

// Обработка входа
Route::post('login', [UserController::class, 'loginAuth'])->name('login.auth');

// Маршрут для дашборда (без использования контроллера)

Route::get('/dashboard', function () {
    return view('layouts.dashboard'); // Возвращает представление dashboard.blade.php
})->name('dashboard')->middleware('auth');

Route::post('/logout', [UserController::class, 'logout'])->name('logout');