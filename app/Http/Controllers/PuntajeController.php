<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Puntaje;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\LazyCollection;

class PuntajeController extends Controller
{
    public function store(Request $request)
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
        if ($puntaje->clasificacion === 'altaalta') {
            $puntaje->dificultad = 'alta';
        }
        $puntaje->save();

        $usuario = User::find(Auth::user()->id);

        $clasificacion_actual = $usuario->dificultad;
        $puntajes = $usuario->puntajes()->get();

        // Calculate the average classification

        if ($puntajes->count() >= 10) {
            $clasificacion_avg = $puntajes->countBy('clasificacion')->sortDesc()->keys()->first();

            if ($clasificacion_avg != $clasificacion_actual) {
                $usuario->dificultad = $clasificacion_avg;
                $usuario->save();
            }
        }

        return redirect()->route('curso.show', ['curso' => $puntaje->curso_id])->with('success', 'Puntaje guardado exitosamente!');
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
        $command = config('app.python_path') . ' ' . config('app.python_script') . ' ' . escapeshellarg($tempFilePath)  . ' 2>&1';

        // Ejecutamos el comando
        $output = shell_exec($command);

        // Verificamos si el output es null
        if ($output === null) {
            return response()->json(['error' => 'Error al ejecutar el script de Python']);
        }

        // Enviamos la clasificación dada por el modelo al usuario
        return response()->json(['clasificacion' => $output]);
    }

    public function getEstadisticas(Request $request)
    {
        $user = User::find($request->id);   
        $puntajes = $user->puntajes()->select('aciertos', 'fallas', 'puntaje')->get();
        $misPuntajes = [
            'jugados' => $puntajes->count(),
            'aciertos' => $puntajes->avg('aciertos'),
            'fallas' => $puntajes->avg('fallas'),
            'puntajes' => $puntajes->avg('puntaje'),
        ];

        $puntajesAll = Puntaje::select('aciertos', 'fallas', 'puntaje')->get();
        $puntajes_generales = [
            'jugados' => $puntajesAll->count(),
            'aciertos' => $puntajesAll->avg('aciertos'),
            'fallas' => $puntajesAll->avg('fallas'),
            'puntajes' => $puntajesAll->avg('puntaje'),
        ];

        $misPuntajesBaja = $this->getPuntajesDificultad('baja', $user);
        $misPuntajesMedia = $this->getPuntajesDificultad('media', $user);
        $misPuntajesAlta = $this->getPuntajesDificultad('alta', $user);

        $misPuntajesDificultad = [
            'baja' => [
                'jugados' => $misPuntajesBaja->count(),
                'aciertos' => $misPuntajesBaja->avg('aciertos'),
                'fallas' => $misPuntajesBaja->avg('fallas'),
                'puntajes' => $misPuntajesBaja->avg('puntaje'),
            ],
            'media' => [
                'jugados' => $misPuntajesMedia->count(),
                'aciertos' => $misPuntajesMedia->avg('aciertos'),
                'fallas' => $misPuntajesMedia->avg('fallas'),
                'puntajes' => $misPuntajesMedia->avg('puntaje'),
            ],
            'alta' => [
                'jugados' => $misPuntajesAlta->count(),
                'aciertos' => $misPuntajesAlta->avg('aciertos'),
                'fallas' => $misPuntajesAlta->avg('fallas'),
                'puntajes' => $misPuntajesAlta->avg('puntaje'),
            ],
        ];

        $puntajes_generales_baja = $this->getPuntajesDificultad('baja');
        $puntajes_generales_media = $this->getPuntajesDificultad('media');
        $puntajes_generales_alta = $this->getPuntajesDificultad('alta');

        $puntajesGeneralesDificultad = [
            'baja' => [
                'jugados' => $puntajes_generales_baja->count(),
                'aciertos' => $puntajes_generales_baja->avg('aciertos'),
                'fallas' => $puntajes_generales_baja->avg('fallas'),
                'puntajes' => $puntajes_generales_baja->avg('puntaje'),
            ],
            'media' => [
                'jugados' => $puntajes_generales_media->count(),
                'aciertos' => $puntajes_generales_media->avg('aciertos'),
                'fallas' => $puntajes_generales_media->avg('fallas'),
                'puntajes' => $puntajes_generales_media->avg('puntaje'),
            ],
            'alta' => [
                'jugados' => $puntajes_generales_alta->count(),
                'aciertos' => $puntajes_generales_alta->avg('aciertos'),
                'fallas' => $puntajes_generales_alta->avg('fallas'),
                'puntajes' => $puntajes_generales_alta->avg('puntaje'),
            ],
        ];

        return response()->json(['mis_puntajes' => $misPuntajes, 'puntajes_generales' => $puntajes_generales, 'mis_puntajes_dificultad' => $misPuntajesDificultad, 'puntajes_generales_dificultad' => $puntajesGeneralesDificultad]);
    }

    public function getPuntajesDificultad(String $dificultad, User $user = null)
    {
        if ($user) {
            return $user->puntajes()->whereHas('cuento', function ($query) use ($dificultad) {
                $query->where('dificultad', $dificultad);
            })->select('aciertos', 'fallas', 'puntaje')->get();
        }

        return Puntaje::whereHas('cuento', function ($query) use ($dificultad) {
            $query->where('dificultad', $dificultad);
        })->select('aciertos', 'fallas', 'puntaje')->get();
    }
}
