<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewRequest;
use App\Models\Review;
use App\Models\Ruta;
use Illuminate\Http\RedirectResponse;

class ReviewController extends Controller
{
    public function store(ReviewRequest $request, Ruta $ruta): RedirectResponse
    {
        Review::updateOrCreate(
            ['user_id' => $request->user()->id, 'ruta_id' => $ruta->id],
            $request->validated(),
        );

        return redirect()
            ->route('rutas.show', $ruta)
            ->with('estado', 'Reseña publicada correctamente.');
    }

    public function destroy(Review $review): RedirectResponse
    {
        $this->authorize('delete', $review);

        $ruta = $review->ruta;
        $review->delete();

        return redirect()
            ->route('rutas.show', $ruta)
            ->with('estado', 'Reseña eliminada correctamente.');
    }
}
