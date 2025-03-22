<?php

use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\GithubAuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


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



Route::get('/auth/google/redirect', [GoogleAuthController::class, 'redirect'])->name('google.redirect');
Route::get('/auth/google/callback', [GoogleAuthController::class, 'callback'])->name('google.callback');

Route::get('/dashboard', function () {
    return view('layouts.dashboard'); // Возвращает представление dashboard.blade.php
})->name('dashboard')->middleware('auth');


require __DIR__ . '/../config/auth.php';

Route::get('/auth/github/redirect', [GithubAuthController::class, 'redirect'])->name('github.redirect');
Route::get('/auth/github/callback', [GithubAuthController::class, 'callback'])->name('github.callback');

