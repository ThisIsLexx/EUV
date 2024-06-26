<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCuentoRequest;
use Inertia\Inertia;

use App\Models\Cuento;
use Illuminate\Http\Request;

class CuentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Cuentos/Index', [
            'cuentos' => Cuento::all(),
            'breadcrumbs' => [
                ['name' => 'Listado de cuentos', 'href' => 'cuento.index', 'current' => true],
            ],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Cuentos/Create', [
            'breadcrumbs' => [
                ['name' => 'Listado de cuentos', 'href' => 'cuento.index', 'current' => false],
                ['name' => 'Crear cuento', 'href' => 'cuento.create', 'current' => true],
            ],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCuentoRequest $request)
    {
        $request->validated();

        $cuento = new Cuento();
        $cuento->titulo = $request->titulo;
        $cuento->contenido = $request->contenido;
        $cuento->dificultad = $request->dificultad;
        $cuento->save();

        return redirect()->route('cuento.index')->with([
            'cuentos' => Cuento::all(),
            'message' => ['title' => 'Cuento creado!', 'description' => 'El cuento ha sido creado correctamente.', 'type' => 'success']
        ]);

        // return Inertia::render('Cuentos/Index', [
        //     'cuentos' => Cuento::all(),
        // ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Cuento $cuento)
    {
        return Inertia::render('Cuentos/Show', [
            'cuento' => $cuento,
            'breadcrumbs' => [
                ['name' => 'Listado de cuentos', 'href' => 'cuento.index', 'current' => false],
                ['name' => 'Mostrar cuento: ' . $cuento->titulo, 'href' => 'cuento.show', 'current' => true],
            ],
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cuento $cuento)
    {
        return Inertia::render('Cuentos/Create', [
            'editable' => true,
            'cuento' => $cuento,
            'breadcrumbs' => [
                ['name' => 'Listado de cuentos', 'href' => 'cuento.index', 'current' => false],
                ['name' => 'Editar cuento', 'href' => 'cuento.edit', 'current' => true],
            ],
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreCuentoRequest $request, Cuento $cuento)
    {
        $request->validated();

        $cuento->titulo = $request->titulo;
        $cuento->contenido = $request->contenido;
        $cuento->dificultad = $request->dificultad;
        $cuento->save();

        return Inertia::render('Cuentos/Index', [
            'cuentos' => Cuento::all(),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cuento $cuento)
    {
        $cuento->delete();

        return redirect()->back();
    }

    public function search(Request $request)
    {
        $query = Cuento::query();

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where('titulo', 'like', "%{$search}%");
        }
        else {
            $query->all();
        }

        $cuentos = $query->get();

        return response()->json($cuentos);
    }

    public function play(int $cuento_id)
    {
        $cuento = Cuento::find($cuento_id);

        return Inertia::render('Cuentos/Play', [
            'cuento' => $cuento,
            'breadcrumbs' => [
                ['name' => 'Listado de cuentos', 'href' => 'cuento.index', 'current' => false],
                ['name' => 'Jugar cuento: ' . $cuento->titulo, 'href' => 'cuento.play', 'current' => true],
            ],
        ]);
    }
}
