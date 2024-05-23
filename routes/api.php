<?php

use App\Http\Controllers\CuentoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/cuentos', [CuentoController::class, 'search'])->name('cuento.filtrado-busqueda');
