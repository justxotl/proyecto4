<?php

namespace Database\Seeders;

use App\Models\Autor;
use App\Models\infoper;
use App\Models\User;
use App\Models\Carrera;
use App\Models\Ficha;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'User',
            'email' => 'test@example.com',
            'password' => Hash::make('12345678'),
        ]);

        infoper::create([
            'ci_us' => '12345678',
            'nombre' => 'Test',
            'apellido' => 'User',
            'user_id' => 1,
        ]);

        Autor::create([
            'ci_autor' => '12345678',
            'nombre_autor' => 'Autor',
            'apellido_autor' => 'Autor',
        ]);

        Carrera::create([
            'nombre' => 'Ingenieria de Sistemas',
        ]);

        Ficha::create([
            'titulo' => 'Titulo 1',
            'fecha' => '2023-10-01',
            'carrera_id' => 1,
            'resumen' => 'Resumen de la ficha 1',
        ]);
    }
}
