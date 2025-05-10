<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TallerUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() && $this->user()->role === 'taller';
    }

    public function rules(): array
    {
        return [
            'taller_name' => ['nullable', 'string', 'max:255'],
            'taller_direccion' => ['nullable', 'string', 'max:255'],
            'taller_telefono' => ['nullable', 'string', 'max:20'],
            'taller_descripcion' => ['nullable', 'string', 'max:1000'],
            'taller_horario' => ['nullable', 'string', 'max:500'],
        ];
    }

    public function attributes(): array
    {
        return [
            'taller_name' => 'nombre del taller',
            'taller_direccion' => 'dirección',
            'taller_telefono' => 'teléfono',
            'taller_descripcion' => 'descripción',
            'taller_horario' => 'horario',
        ];
    }
}