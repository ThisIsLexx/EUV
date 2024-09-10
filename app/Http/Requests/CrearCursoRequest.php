<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CrearCursoRequest extends FormRequest
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
            'codigo' => 'required|unique:cursos,codigo|min:3',
            'titulo' => 'required',
            'descripcion' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'codigo.required' => 'El código del curso es requerido',
            'codigo.unique' => 'Ya existe un curso con ese código!',
            'codigo.min' => 'El código del curso debe tener al menos 3 caracteres',
        ];
    }
}
