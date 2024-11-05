<?php

use App\Http\Controllers\CuentoController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\PracticeController;
use App\Http\Controllers\PuntajeController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Models\Practice;
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
    Route::post('/practice/store', [PracticeController::class, 'store'])->name('practice.store');
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
            'user_clasification' => auth()->user()->dificultad,
        ]);
    })->name('estadisticas');

    Route::get('/modo-practica', function () {
        $practices = Practice::all();
        return Inertia::render('Practice', [
            'dificultad' => auth()->user()->dificultad,
            'promedios' => ['tiempo' => $practices->avg('tiempo'), 'palabras_correctas' => $practices->avg('palabras_correctas'), 'ppm' => $practices->avg('ppm')],
            'breadcrumbs' => [
                ['name' => 'Modo Práctica', 'route' => 'modo-practica', 'current' => true],
            ],
        ]);
    })->name('practice');
});
