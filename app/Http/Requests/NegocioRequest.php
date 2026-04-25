<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class NegocioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return [
            'nombre' => ['required', 'string', 'max:255'],
            'descripcion' => ['required', 'string', 'max:2000'],
            'region_id' => ['required', Rule::exists('regiones', 'id')],
            'categoria' => ['required', Rule::in(['alojamiento', 'restaurante', 'artesania', 'experiencia', 'transporte', 'otro'])],
            'direccion' => ['required', 'string', 'max:255'],
            'lat' => ['required', 'numeric', 'between:-90,90'],
            'lng' => ['required', 'numeric', 'between:-180,180'],
            'telefono' => ['nullable', 'string', 'max:30'],
            'email' => ['nullable', 'email', 'max:255'],
            'sitio_web' => ['nullable', 'url', 'max:255'],
            'plan' => ['required', Rule::in(['basico', 'pro', 'premium'])],
            'imagen' => ['nullable', 'image', 'max:2048'],
        ];
    }

    public function attributes(): array
    {
        return [
            'nombre' => 'nombre',
            'descripcion' => 'descripción',
            'region_id' => 'región',
            'categoria' => 'categoría',
            'direccion' => 'dirección',
            'lat' => 'latitud',
            'lng' => 'longitud',
            'telefono' => 'teléfono',
            'email' => 'correo electrónico',
            'sitio_web' => 'sitio web',
            'plan' => 'plan',
            'imagen' => 'imagen',
        ];
    }
}
