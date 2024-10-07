<?php

namespace App\Http\Controllers;

use App\Http\Requests\CrearCursoRequest;
use App\Http\Requests\UnirseCursoRequest;
use Inertia\Inertia;
use App\Models\Curso;
use Illuminate\Http\Request;

use App\Models\Cuento;
use App\Models\User;

class CursoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $usuario = User::find($user->id);

        return Inertia::render('Cursos/CursoRegistro', [
            'titulo' => 'Mis cursos',
            'mis_cursos' => $usuario->cursos()->get(),
            'breadcrumbs' => [
                ['name' => 'Listado de cursos', 'href' => 'curso.index', 'current' => true],
            ],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CrearCursoRequest $request)
    {
        $curso = new Curso();
        $curso->codigo = $request->codigo;
        $curso->titulo = $request->titulo;
        $curso->descripcion = $request->descripcion;
        $curso->color = $request->color;
        $curso->user_id = auth()->user()->id;
        $curso->save();

        $user = auth()->user();
        $usuario = User::find($user->id);
        $usuario->cursos()->attach($curso);

        return redirect()->route('curso.index')->with('success', 'Curso creado exitosamente!');

    }

    /**
     * Display the specified resource.
     */
    public function show(Curso $curso)
    {
        $tutor = $curso->user()->get();
        $personas = $curso->alumnos()->get()->whereNotIn('id', $tutor->pluck('id'))->map(function($persona) {
            return [
                'id' => $persona->id,
                'name' => $persona->name,
                'dificultad' => $persona->dificultad,
            ];
        });
        $asignaciones = $curso->cuentos()->get();
        $cuentos = Cuento::whereNotIn('id', $asignaciones->pluck('id'))->get()->map(function($cuento) {
            return [
            'id' => $cuento->id,
            'titulo' => $cuento->titulo,
            'dificultad' => $cuento->dificultad,
            ];
        });
        $puntajes = $curso->puntajes()->where('user_id', auth()->user()->id)->orderBy('puntaje', 'desc')->get();


        return Inertia::render('Cursos/CursoIndex',[
            'curso' => $curso,
            'tutor' => [$curso->user->name, $curso->user->email],
            'personas' => $personas,
            'asignaciones' => $asignaciones,
            'cuentos' => $cuentos,
            'puntajes' => $puntajes,
            'breadcrumbs' => [
                ['name' => 'Listado de cursos', 'href' => 'curso.index', 'current' => false],
                ['name' => $curso->codigo, 'href' => '', 'current' => true],
            ],
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Curso $curso)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Curso $curso)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Curso $curso)
    {
        //
    }

    public function unirse(UnirseCursoRequest $request)
    {
        $user = auth()->user();

        $usuario = User::find($user->id);
        $curso = Curso::where('codigo', $request->codigo)->first();

        if (!$curso) {
            return redirect()->back()->with('danger', 'No se encontró un curso con ese código!');
        }

        if (!$usuario->cursos()->find($curso->id)) {
            $usuario->cursos()->attach($curso);
            return redirect()->back()->with('success', 'Registro exitoso!');
        }
        else {
            return redirect()->back();
        }

    }

    public function cancelar(Curso $curso)
    {
        $user = auth()->user();
        $usuario = User::find($user->id);

        $usuario->cursos()->detach($curso);

        return redirect()->back()->with('success', 'Registro cancelado correctamente!');
    }

    public function asignar(Request $request, Curso $curso)
    {
        $request->validate([
            'selectedCuentos' => 'required|array',
        ]);
        foreach ($request->selectedCuentos as $cuento) {
            $curso->cuentos()->attach($cuento['id']);
        }

        return redirect()->back()->with('success', 'Textos asignados correctamente!');
    }

    public function desasignar(Cuento $cuento, Curso $curso)
    {
        $curso->cuentos()->detach($cuento);

        return redirect()->back()->with('success', 'Texto desasignado correctamente!');
    }

    public function listadoCursos()
    {
        $cursos = Curso::all();
        /* $tutor =  */


        return Inertia::render('Cursos/CursoListado', [
            'cursos' => $cursos,
            /* 'tutor' => $tutor, */
            'breadcrumbs' => [
                ['name' => 'Cursos', 'href' => '', 'current' => true],
            ],
        ]);
    }
}
