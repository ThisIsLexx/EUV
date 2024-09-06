<?php

namespace App\Http\Controllers;

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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Curso $curso)
    {
        return Inertia::render('Cursos/CursoIndex',[
            'curso' => $curso,
            'baja' => Cuento::where('dificultad', 'baja')->get(),
            'media' => Cuento::where('dificultad', 'media')->get(),
            'alta' => Cuento::where('dificultad', 'alta')->get(),
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
            return redirect()->route('curso.index');
        }

        if (!$usuario->cursos()->find($curso->id)) {
            $usuario->cursos()->attach($curso);
        }
        else {
            return redirect()->route('curso.index');
        }

        return Inertia::render('Cursos/CursoRegistro', [
            'titulo' => 'Mis cursos',
            'mis_cursos' => $usuario->cursos()->get(),
            'breadcrumbs' => [
                ['name' => 'Listado de cursos', 'href' => 'curso.index', 'current' => true],
            ],
        ]);
    }

    public function cancelar(Curso $curso)
    {
        $user = auth()->user();
        $usuario = User::find($user->id);

        $usuario->cursos()->detach($curso);

        return Inertia::render('Cursos/CursoRegistro', [
            'titulo' => 'Mis cursos',
            'mis_cursos' => $usuario->cursos()->get(),
            'breadcrumbs' => [
                ['name' => 'Listado de cursos', 'href' => 'curso.index', 'current' => true],
            ],
        ]);
    }
}
