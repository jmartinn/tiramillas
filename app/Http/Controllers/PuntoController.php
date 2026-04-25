<?php

namespace App\Http\Controllers;

use App\Http\Requests\PuntoRequest;
use App\Models\Punto;
use App\Models\Region;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PuntoController extends Controller
{
    public function index(Request $request): View
    {
        $puntos = Punto::query()
            ->with(['region', 'autor'])
            ->when($request->filled('region'), fn ($q) => $q->whereHas('region', fn ($r) => $r->where('slug', $request->string('region'))))
            ->when($request->filled('categoria'), fn ($q) => $q->where('categoria', $request->string('categoria')))
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('puntos.index', [
            'puntos' => $puntos,
            'regiones' => Region::orderBy('nombre')->get(),
            'filtros' => [
                'region' => $request->string('region')->toString(),
                'categoria' => $request->string('categoria')->toString(),
            ],
        ]);
    }

    public function show(Punto $punto): View
    {
        $punto->load(['region', 'autor', 'rutas']);

        return view('puntos.show', ['punto' => $punto]);
    }

    public function create(): View
    {
        $this->authorize('create', Punto::class);

        return view('puntos.create', [
            'regiones' => Region::orderBy('nombre')->get(),
        ]);
    }

    public function store(PuntoRequest $request): RedirectResponse
    {
        $datos = $request->validated();
        $datos['user_id'] = $request->user()->id;
        $datos['slug'] = $this->slugUnico($datos['titulo']);
        $datos['imagen_path'] = $this->guardarImagen($request);

        $punto = Punto::create($datos);

        return redirect()
            ->route('puntos.show', $punto)
            ->with('estado', 'Punto creado correctamente.');
    }

    public function edit(Punto $punto): View
    {
        $this->authorize('update', $punto);

        return view('puntos.edit', [
            'punto' => $punto,
            'regiones' => Region::orderBy('nombre')->get(),
        ]);
    }

    public function update(PuntoRequest $request, Punto $punto): RedirectResponse
    {
        $this->authorize('update', $punto);

        $datos = $request->validated();

        if ($datos['titulo'] !== $punto->titulo) {
            $datos['slug'] = $this->slugUnico($datos['titulo'], $punto->id);
        }

        if ($nuevaImagen = $this->guardarImagen($request)) {
            if ($punto->imagen_path) {
                Storage::disk('public')->delete($punto->imagen_path);
            }
            $datos['imagen_path'] = $nuevaImagen;
        }

        $punto->update($datos);

        return redirect()
            ->route('puntos.show', $punto)
            ->with('estado', 'Punto actualizado correctamente.');
    }

    public function destroy(Punto $punto): RedirectResponse
    {
        $this->authorize('delete', $punto);

        if ($punto->imagen_path) {
            Storage::disk('public')->delete($punto->imagen_path);
        }

        $punto->delete();

        return redirect()
            ->route('puntos.index')
            ->with('estado', 'Punto eliminado correctamente.');
    }

    private function slugUnico(string $titulo, ?int $ignorarId = null): string
    {
        $base = Str::slug($titulo);
        $slug = $base;
        $contador = 2;

        $query = fn (string $s) => Punto::where('slug', $s)
            ->when($ignorarId, fn ($q) => $q->where('id', '!=', $ignorarId));

        while ($query($slug)->exists()) {
            $slug = $base.'-'.$contador++;
        }

        return $slug;
    }

    private function guardarImagen(Request $request): ?string
    {
        if (! $request->hasFile('imagen')) {
            return null;
        }

        return $request->file('imagen')->store('puntos', 'public');
    }
}
