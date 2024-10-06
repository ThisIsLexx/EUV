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
        $puntaje->clasificacion = $request->clasificacion;
        $puntaje->save();
    }

    public function clasificarUsuario(Request $request)
    {
        $data = $request->toArray();

        $python_request = [
            "aciertos" => $data[0],
            "total_palabras" => $data[1],
            "score" => $data[2]
        ];

        // Convertimos los datos a JSON
        $jsonData = json_encode($python_request);

        $tempFilePath = sys_get_temp_dir() . '/data.json';
        file_put_contents($tempFilePath, $jsonData);

        // Especificamos correctamente el comando para Python
        $command = 'C:/laragon/bin/python/python-3.10/python.exe C:/laragon/www/EUV/clasificarUsuario.py ' . escapeshellarg($tempFilePath)  . ' 2>&1';

        // Ejecutamos el comando
        $output = shell_exec($command);

        // Verificamos si el output es null
        if ($output === null) {
            return response()->json(['error' => 'Error al ejecutar el script de Python']);
        }

        // Enviamos la clasificación dada por el modelo al usuario
        return response()->json(['clasificacion' => $output]);
    }
}
