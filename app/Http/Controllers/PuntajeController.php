<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Puntaje;
use Illuminate\Support\Facades\Auth;

class PuntajeController extends Controller
{
    public function store(Request $request): void
    {
        $puntaje = New Puntaje();
        $puntaje->curso_id = $request->curso_id;
        $puntaje->cuento_id = $request->cuento_id;
        $puntaje->user_id = Auth::user()->id;
        $puntaje->aciertos = $request->palabras_correctas;
        $puntaje->total_palabras = $request->total_palabras;
        $puntaje->fallas = $request->total_palabras - $request->palabras_correctas;
        $puntaje->puntaje = $request->score;
        $puntaje->save();
    }
}
