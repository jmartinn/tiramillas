<?php

namespace App\Http\Controllers;

use App\Models\Punto;
use App\Models\Ruta;
use App\Models\User;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $rutasDestacadas = Ruta::query()
            ->with(['region', 'autor'])
            ->where('destacada', true)
            ->latest()
            ->take(6)
            ->get();

        if ($rutasDestacadas->isEmpty()) {
            $rutasDestacadas = Ruta::query()
                ->with(['region', 'autor'])
                ->latest()
                ->take(6)
                ->get();
        }

        $stats = [
            'usuarios' => User::count(),
            'rutas' => Ruta::count(),
            'puntos' => Punto::count(),
        ];

        $ultimaRuta = Ruta::query()
            ->with('region')
            ->latest()
            ->first();

        $iniciales = User::query()
            ->inRandomOrder()
            ->take(3)
            ->pluck('name')
            ->map(fn (string $nombre) => mb_strtoupper(mb_substr($nombre, 0, 1)));

        return view('welcome', [
            'rutasDestacadas' => $rutasDestacadas,
            'stats' => $stats,
            'ultimaRuta' => $ultimaRuta,
            'iniciales' => $iniciales,
        ]);
    }
}
