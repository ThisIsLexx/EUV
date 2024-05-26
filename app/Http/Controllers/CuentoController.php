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
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Cuentos/Create');
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
        $cuento->save();

        return Inertia::render('Cuentos/Index', [
            'cuentos' => Cuento::all(),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Cuento $cuento)
    {
        return Inertia::render('Cuentos/Show', [
            'cuento' => $cuento,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cuento $cuento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cuento $cuento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cuento $cuento)
    {
        $cuento->delete();

        return redirect()->back()->with(
            ['cuentos' => Cuento::all()]
        );
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
}
