<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RutaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return [
            'titulo' => ['required', 'string', 'max:255'],
            'descripcion' => ['required', 'string', 'max:500'],
            'descripcion_larga' => ['required', 'string', 'min:50'],
            'region_id' => ['required', Rule::exists('regiones', 'id')],
            'categoria' => ['required', Rule::in(['naturaleza', 'cultura', 'gastronomia', 'patrimonio'])],
            'dificultad' => ['required', Rule::in(['facil', 'moderada', 'exigente'])],
            'distancia_km' => ['required', 'numeric', 'min:0.1', 'max:9999.99'],
            'duracion_min' => ['required', 'integer', 'min:5', 'max:65535'],
            'lat_inicio' => ['required', 'numeric', 'between:-90,90'],
            'lng_inicio' => ['required', 'numeric', 'between:-180,180'],
            'punto_inicio' => ['required', 'string', 'max:255'],
            'punto_fin' => ['required', 'string', 'max:255'],
            'mejor_epoca' => ['nullable', 'string', 'max:255'],
            'destacada' => ['nullable', 'boolean'],
            'imagen' => ['nullable', 'image', 'max:2048'],
        ];
    }

    public function attributes(): array
    {
        return [
            'titulo' => 'título',
            'descripcion' => 'descripción',
            'descripcion_larga' => 'descripción larga',
            'region_id' => 'región',
            'categoria' => 'categoría',
            'dificultad' => 'dificultad',
            'distancia_km' => 'distancia',
            'duracion_min' => 'duración',
            'lat_inicio' => 'latitud de inicio',
            'lng_inicio' => 'longitud de inicio',
            'punto_inicio' => 'punto de inicio',
            'punto_fin' => 'punto final',
            'mejor_epoca' => 'mejor época',
            'destacada' => 'destacada',
            'imagen' => 'imagen',
        ];
    }
}
