<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\NegocioController;
use App\Http\Controllers\PuntoController;
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

Route::resource('puntos', PuntoController::class)
    ->except(['index', 'show'])
    ->middleware('auth');

Route::resource('puntos', PuntoController::class)
    ->only(['index', 'show']);

Route::get('/negocios/sumate', [NegocioController::class, 'sumate'])->name('negocios.sumate');

Route::resource('negocios', NegocioController::class)
    ->except(['index', 'show'])
    ->middleware('auth');

Route::resource('negocios', NegocioController::class)
    ->only(['index', 'show']);
