<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RutaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

Route::resource('rutas', RutaController::class)
    ->except(['index', 'show'])
    ->middleware('auth');

Route::resource('rutas', RutaController::class)
    ->only(['index', 'show']);
