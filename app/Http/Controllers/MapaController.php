<?php

namespace App\Http\Controllers;

use App\Models\Negocio;
use App\Models\Punto;
use App\Models\Ruta;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class MapaController extends Controller
{
    public function index(): View
    {
        return view('mapa');
    }

    public function datos(): JsonResponse
    {
        $rutas = Ruta::query()
            ->select('id', 'titulo', 'slug', 'lat_inicio', 'lng_inicio', 'categoria')
            ->get()
            ->map(fn (Ruta $ruta) => [
                'tipo' => 'ruta',
                'titulo' => $ruta->titulo,
                'lat' => (float) $ruta->lat_inicio,
                'lng' => (float) $ruta->lng_inicio,
                'categoria' => $ruta->categoria,
                'url' => route('rutas.show', $ruta),
            ]);

        $puntos = Punto::query()
            ->select('id', 'titulo', 'slug', 'lat', 'lng', 'categoria')
            ->get()
            ->map(fn (Punto $punto) => [
                'tipo' => 'punto',
                'titulo' => $punto->titulo,
                'lat' => (float) $punto->lat,
                'lng' => (float) $punto->lng,
                'categoria' => $punto->categoria,
                'url' => route('puntos.show', $punto),
            ]);

        $negocios = Negocio::query()
            ->select('id', 'nombre', 'slug', 'lat', 'lng', 'categoria')
            ->get()
            ->map(fn (Negocio $negocio) => [
                'tipo' => 'negocio',
                'titulo' => $negocio->nombre,
                'lat' => (float) $negocio->lat,
                'lng' => (float) $negocio->lng,
                'categoria' => $negocio->categoria,
                'url' => route('negocios.show', $negocio),
            ]);

        return response()->json($rutas->concat($puntos)->concat($negocios)->values());
    }
}
