<?php

namespace App\Http\Controllers;

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
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required',
            'contenido' => 'required',
        ]);

        $cuento = new Cuento();
        $cuento->titulo = $request->titulo;
        $cuento->contenido = $request->contenido;
        $cuento->save();

        return redirect()->route('cuento.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cuento $cuento)
    {
        //
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
        //
    }
}
