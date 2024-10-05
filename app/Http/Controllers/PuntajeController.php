<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Puntaje;
use Illuminate\Database\Eloquent\Casts\Json;
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

    public function clasificarUsuario()
    {
        // Obtenemos los puntajes del usuario
        $usuario = Auth::user();
        $puntajes = Puntaje::where('user_id', $usuario->id)->get();

        $aciertos = [];
        $total_palabras = [];
        $score = [];

        // Obtenemos los aciertos, total de palabras y puntaje de cada puntaje
        foreach ($puntajes as $puntaje) {
            array_push($aciertos, $puntaje->aciertos);
            array_push($total_palabras, $puntaje->total_palabras);
            array_push($score, $puntaje->puntaje);
        }

        // Preparamos los datos para el script de Python
        $data = [
            "aciertos" => $aciertos,
            "total_palabras" => $total_palabras,
            "score" => $score
        ];

        // Convertimos los datos a JSON correctamente con json_encode
        $jsonData = json_encode($data);

        $jsonData = escapeshellarg($jsonData);



        // Ejecutamos el script de Python
        $command = "C:/laragon/bin/python/python-3.10/python.exe C:/laragon/www/EUV/clasificarUsuario.py " . $jsonData;
        $output = shell_exec($command);

        dd($output);

        // Verificamos si el output es null
        if ($output === null) {
            return response()->json(['error' => 'Error al ejecutar el script de Python']);
        }

        // Enviamos la clasificación dada por el modelo al usuario
        return response()->json(['clasificacion' => $output]);
    }
}
