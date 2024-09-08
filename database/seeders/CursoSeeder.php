<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Curso;

class CursoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Curso::create([
            'codigo' => 'CURSO-001',
            'titulo' => 'Conceptos básicos del inglés',
            'descripcion' => 'En este curso encontrará cuentos relacionados al nivel básico del idioma inglés.',
            'user_id' => 1,
        ]);
        Curso::create([
            'codigo' => 'CURSO-002',
            'titulo' => 'Curso de programación',
            'descripcion' => 'Curso de programación en Vue',
            'user_id' => 1,
        ]);
    }
}
