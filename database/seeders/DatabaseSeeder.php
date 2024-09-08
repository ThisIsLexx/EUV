<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Curso;
use App\Models\Cuento;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Database\Factories\UserFactory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call([
            UserSeeder::class,
            CuentoSeeder::class,
            CursoSeeder::class,

        ]);
        $curso = Curso::first();

        User::factory()->count(10)->create()->each(function ($user) use ($curso) {
            $user->cursos()->attach($curso);
        });
    }
}
