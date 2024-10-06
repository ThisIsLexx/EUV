<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin user
        User::factory()->create([
            'name' => 'Usuario Administrador',
            'email' => 'admin@test.com',
            'password' => Hash::make('password'),
        ]);

        // Regular user
        User::factory()->create([
            'name' => 'Usuario Regular',
            'email' => 'user@test.com',
            'password' => Hash::make('password'),
        ]);
    }
}
