<?php

namespace App\Http\Controllers;

use App\Http\Requests\RutaRequest;
use App\Models\Region;
use App\Models\Ruta;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class RutaController extends Controller
{
    public function index(Request $request): View
    {
        $rutas = Ruta::query()
            ->with(['region', 'autor'])
            ->when($request->filled('region'), fn ($q) => $q->whereHas('region', fn ($r) => $r->where('slug', $request->string('region'))))
            ->when($request->filled('categoria'), fn ($q) => $q->where('categoria', $request->string('categoria')))
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('rutas.index', [
            'rutas' => $rutas,
            'regiones' => Region::orderBy('nombre')->get(),
            'filtros' => [
                'region' => $request->string('region')->toString(),
                'categoria' => $request->string('categoria')->toString(),
            ],
        ]);
    }

    public function show(Ruta $ruta): View
    {
        $ruta->load(['region', 'autor', 'puntos.region', 'reviews.autor']);

        return view('rutas.show', ['ruta' => $ruta]);
    }

    public function create(): View
    {
        $this->authorize('create', Ruta::class);

        return view('rutas.create', [
            'regiones' => Region::orderBy('nombre')->get(),
        ]);
    }

    public function store(RutaRequest $request): RedirectResponse
    {
        $datos = $request->validated();
        $datos['user_id'] = $request->user()->id;
        $datos['slug'] = $this->slugUnico($datos['titulo']);
        $datos['destacada'] = $request->boolean('destacada');
        $datos['imagen_path'] = $this->guardarImagen($request);

        $ruta = Ruta::create($datos);

        return redirect()
            ->route('rutas.show', $ruta)
            ->with('estado', 'Ruta creada correctamente.');
    }

    public function edit(Ruta $ruta): View
    {
        $this->authorize('update', $ruta);

        return view('rutas.edit', [
            'ruta' => $ruta,
            'regiones' => Region::orderBy('nombre')->get(),
        ]);
    }

    public function update(RutaRequest $request, Ruta $ruta): RedirectResponse
    {
        $this->authorize('update', $ruta);

        $datos = $request->validated();
        $datos['destacada'] = $request->boolean('destacada');

        if ($datos['titulo'] !== $ruta->titulo) {
            $datos['slug'] = $this->slugUnico($datos['titulo'], $ruta->id);
        }

        if ($nuevaImagen = $this->guardarImagen($request)) {
            if ($ruta->imagen_path) {
                Storage::disk('public')->delete($ruta->imagen_path);
            }
            $datos['imagen_path'] = $nuevaImagen;
        }

        $ruta->update($datos);

        return redirect()
            ->route('rutas.show', $ruta)
            ->with('estado', 'Ruta actualizada correctamente.');
    }

    public function destroy(Ruta $ruta): RedirectResponse
    {
        $this->authorize('delete', $ruta);

        if ($ruta->imagen_path) {
            Storage::disk('public')->delete($ruta->imagen_path);
        }

        $ruta->delete();

        return redirect()
            ->route('rutas.index')
            ->with('estado', 'Ruta eliminada correctamente.');
    }

    private function slugUnico(string $titulo, ?int $ignorarId = null): string
    {
        $base = Str::slug($titulo);
        $slug = $base;
        $contador = 2;

        $query = fn (string $s) => Ruta::where('slug', $s)
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

        return $request->file('imagen')->store('rutas', 'public');
    }
}
