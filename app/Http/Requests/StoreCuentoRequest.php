<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCuentoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'titulo' => 'required',
            'contenido' => 'required',
            'dificultad' => 'required|in:baja,media,alta',
        ];
    }

    public function messages(): array
    {
        return [
            'titulo.required' => 'El titulo es requerido',
            'contenido.required' => 'El contenido del cuento es requerido',
            'dificultad.required' => 'La dificultad del cuento es requerida',
            'dificultad.in' => 'La dificultad del cuento debe ser baja, media o alta',
        ];
    }
}
