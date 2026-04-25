<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PuntoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return [
            'titulo' => ['required', 'string', 'max:255'],
            'descripcion' => ['required', 'string', 'max:2000'],
            'region_id' => ['required', Rule::exists('regiones', 'id')],
            'categoria' => ['required', Rule::in(['monumento', 'mirador', 'museo', 'gastronomia', 'naturaleza', 'otro'])],
            'lat' => ['required', 'numeric', 'between:-90,90'],
            'lng' => ['required', 'numeric', 'between:-180,180'],
            'imagen' => ['nullable', 'image', 'max:2048'],
        ];
    }

    public function attributes(): array
    {
        return [
            'titulo' => 'título',
            'descripcion' => 'descripción',
            'region_id' => 'región',
            'categoria' => 'categoría',
            'lat' => 'latitud',
            'lng' => 'longitud',
            'imagen' => 'imagen',
        ];
    }
}
