<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return [
            'puntuacion' => ['required', 'integer', 'between:1,5'],
            'cuerpo' => ['required', 'string', 'min:10', 'max:2000'],
        ];
    }

    public function attributes(): array
    {
        return [
            'puntuacion' => 'puntuación',
            'cuerpo' => 'comentario',
        ];
    }
}
