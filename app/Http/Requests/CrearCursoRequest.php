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
            'titulo' => 'required|min:3|max:255',
            'descripcion' => 'required|min:5|max:255',
            'color' => 'required|string|in:blue,emerald,red,amber,purple,orange,gray',
        ];
    }

    public function messages(): array
    {
        return [
            'codigo.required' => 'El código del curso es requerido',
            'codigo.unique' => 'Ya existe un curso con ese código!',
            'codigo.min' => 'El código del curso debe tener al menos 3 caracteres',
            'titulo.required' => 'El título del curso es requerido',
            'titulo.min' => 'El título del curso debe tener al menos 3 caracteres',
            'titulo.max' => 'El título del curso no debe tener más de 255 caracteres',
            'descripcion.required' => 'La descripción del curso es requerida',
            'descripcion.min' => 'La descripción del curso debe tener al menos 5 caracteres',
            'descripcion.max' => 'La descripción del curso no debe tener más de 255 caracteres',
            'color.required' => 'El color del curso es requerido',
            'color.string' => 'El color del curso debe ser una cadena de texto',
            'color.in' => 'El color del curso no es válido',
        ];
    }
}
