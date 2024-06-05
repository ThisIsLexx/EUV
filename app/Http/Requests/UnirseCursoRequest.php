<?php

namespace App\Http\Requests;

use App\Models\Curso;
use Illuminate\Foundation\Http\FormRequest;

class UnirseCursoRequest extends FormRequest
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
        $codigos = Curso::all()->pluck('codigo')->toArray();
        $user = auth()->user();
        $codigos_registrados = $user->cursos->pluck('codigo')->toArray();
        return [
            'codigo' => 'required|in:' . implode(',', $codigos) . '|not_in:' . implode(',', $codigos_registrados)
        ];
    }

    public function messages(): array
    {
        return [
            'codigo.required' => 'El código del curso es requerido',
            'codigo.in' => 'No se encontró un curso con ese código!',
            'codigo.not_in' => 'Ya estás inscrito en ese curso!',
        ];
    }
}
