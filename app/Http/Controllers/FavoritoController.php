<?php

namespace App\Http\Controllers;

use App\Models\Negocio;
use App\Models\Punto;
use App\Models\Ruta;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class FavoritoController extends Controller
{
    public function ruta(Request $request, Ruta $ruta): RedirectResponse
    {
        $request->user()->rutasFavoritas()->toggle($ruta->id);

        return back()->with('estado', 'Favoritos actualizados.');
    }

    public function punto(Request $request, Punto $punto): RedirectResponse
    {
        $request->user()->puntosFavoritos()->toggle($punto->id);

        return back()->with('estado', 'Favoritos actualizados.');
    }

    public function negocio(Request $request, Negocio $negocio): RedirectResponse
    {
        $request->user()->negociosFavoritos()->toggle($negocio->id);

        return back()->with('estado', 'Favoritos actualizados.');
    }
}
