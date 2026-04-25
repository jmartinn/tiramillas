<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FavoritoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NegocioController;
use App\Http\Controllers\PuntoController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\RutaController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

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

Route::middleware('auth')->group(function () {
    Route::post('/rutas/{ruta}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');

    Route::post('/rutas/{ruta}/favorito', [FavoritoController::class, 'ruta'])->name('favoritos.ruta');
    Route::post('/puntos/{punto}/favorito', [FavoritoController::class, 'punto'])->name('favoritos.punto');
    Route::post('/negocios/{negocio}/favorito', [FavoritoController::class, 'negocio'])->name('favoritos.negocio');
});
