<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Practice;
use Illuminate\Support\Facades\Auth;

class PracticeController extends Controller
{
    public function rules() {
        return [
            'tiempo' => 'required|integer',
            'total_palabras' => 'required|integer',
            'palabras_correctas' => 'required|integer',
            'ppm' => 'required|numeric',
            'dificultad' => 'required|string'
        ];
    }

    public function store(Request $request) {
        $request->validate($this->rules());

        $practice = new Practice();
        $practice->user_id = Auth::user()->id;
        $practice->tiempo = $request->tiempo;
        $practice->total_palabras = $request->total_palabras;
        $practice->palabras_correctas = $request->palabras_correctas;
        $practice->ppm = $request->ppm;
        $practice->dificultad = $request->dificultad;
        $practice->save();
    }
}
