<?php

namespace App\Http\Controllers;

use App\Http\Requests\NegocioRequest;
use App\Models\Negocio;
use App\Models\Region;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class NegocioController extends Controller
{
    public function index(Request $request): View
    {
        $negocios = Negocio::query()
            ->with(['region', 'dueno'])
            ->when($request->filled('region'), fn ($q) => $q->whereHas('region', fn ($r) => $r->where('slug', $request->string('region'))))
            ->when($request->filled('categoria'), fn ($q) => $q->where('categoria', $request->string('categoria')))
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('negocios.index', [
            'negocios' => $negocios,
            'regiones' => Region::orderBy('nombre')->get(),
            'filtros' => [
                'region' => $request->string('region')->toString(),
                'categoria' => $request->string('categoria')->toString(),
            ],
        ]);
    }

    public function sumate(): View
    {
        return view('negocios.sumate');
    }

    public function show(Negocio $negocio): View
    {
        $negocio->load(['region', 'dueno']);

        return view('negocios.show', ['negocio' => $negocio]);
    }

    public function create(): View
    {
        $this->authorize('create', Negocio::class);

        return view('negocios.create', [
            'regiones' => Region::orderBy('nombre')->get(),
        ]);
    }

    public function store(NegocioRequest $request): RedirectResponse
    {
        $datos = $request->validated();
        $datos['user_id'] = $request->user()->id;
        $datos['slug'] = $this->slugUnico($datos['nombre']);
        $datos['imagen_path'] = $this->guardarImagen($request);

        $negocio = Negocio::create($datos);

        return redirect()
            ->route('negocios.show', $negocio)
            ->with('estado', 'Negocio creado correctamente.');
    }

    public function edit(Negocio $negocio): View
    {
        $this->authorize('update', $negocio);

        return view('negocios.edit', [
            'negocio' => $negocio,
            'regiones' => Region::orderBy('nombre')->get(),
        ]);
    }

    public function update(NegocioRequest $request, Negocio $negocio): RedirectResponse
    {
        $this->authorize('update', $negocio);

        $datos = $request->validated();

        if ($datos['nombre'] !== $negocio->nombre) {
            $datos['slug'] = $this->slugUnico($datos['nombre'], $negocio->id);
        }

        if ($nuevaImagen = $this->guardarImagen($request)) {
            if ($negocio->imagen_path) {
                Storage::disk('public')->delete($negocio->imagen_path);
            }
            $datos['imagen_path'] = $nuevaImagen;
        }

        $negocio->update($datos);

        return redirect()
            ->route('negocios.show', $negocio)
            ->with('estado', 'Negocio actualizado correctamente.');
    }

    public function destroy(Negocio $negocio): RedirectResponse
    {
        $this->authorize('delete', $negocio);

        if ($negocio->imagen_path) {
            Storage::disk('public')->delete($negocio->imagen_path);
        }

        $negocio->delete();

        return redirect()
            ->route('negocios.index')
            ->with('estado', 'Negocio eliminado correctamente.');
    }

    private function slugUnico(string $nombre, ?int $ignorarId = null): string
    {
        $base = Str::slug($nombre);
        $slug = $base;
        $contador = 2;

        $query = fn (string $s) => Negocio::where('slug', $s)
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

        return $request->file('imagen')->store('negocios', 'public');
    }
}
