<?php

use App\Http\Controllers\CuentoController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\PuntajeController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Models\Cuento;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
    Route::resource('cuento', CuentoController::class);
    Route::get('/cuentos', [CuentoController::class, 'listadoCuentos'])->name('cuento.cuentos');
    Route::resource('curso', CursoController::class);
    Route::resource('puntaje', PuntajeController::class);
    Route::post('/clasificar-usuario', [PuntajeController::class, 'clasificarUsuario'])->name('clasificar');
    Route::post('/curso/unirse', [CursoController::class, 'unirse'])->name('curso.unirse');
    Route::post('/curso/{curso}/asignar', [CursoController::class, 'asignar'])->name('curso.asignar');
    Route::get('/curso/{curso}/cuento/{cuento}/play', [CuentoController::class, 'play'])->name('curso.play');
    Route::get('/cursos', [CursoController::class, 'listadoCursos'])->name('curso.cursos');
    Route::post('/curso/{curso}/cancelar', [CursoController::class, 'cancelar'])->name('curso.cancelar');
    Route::get('/estadisticas', function () {
        return Inertia::render('Estadisticas/MisEstadisticas', [
            'breadcrumbs' => [
                ['name' => 'Mis Estadísticas', 'route' => 'estadisticas', 'current' => true],
            ],
            'user_id' => auth()->user()->id,
        ]);
    })->name('estadisticas');

    Route::get('/modo-practica', function () {
        return Inertia::render('Practice', [
            'breadcrumbs' => [
                ['name' => 'Modo Práctica', 'route' => 'modo-practica', 'current' => true],
            ],
        ]);
    })->name('practice');
});
