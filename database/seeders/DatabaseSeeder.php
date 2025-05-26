<?php

namespace Database\Seeders;

use App\Models\Autor;
use App\Models\infoper;
use App\Models\User;
use App\Models\Carrera;
use App\Models\Ficha;
use App\Models\PreguntaUser;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

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

        PreguntaUser::create([
            'user_id' => 1,
            'pregunta_uno' => '¿Cuál es tu color favorito?',
            'pregunta_dos' => '¿Cuál es tu animal favorito?',
            'respuesta_uno' => 'Azul',
            'respuesta_dos' => 'Perro',
        ]);

        Autor::create([
            'ci_autor' => '12345678',
            'nombre_autor' => 'Registro',
            'apellido_autor' => 'De Autor',
        ]);

        Carrera::create([
            'nombre' => 'Ingenieria en Sistemas',
        ]);

        Ficha::create([
            'titulo' => 'Titulo 1',
            'fecha' => '2023-10-01',
            'carrera_id' => 1,
            'resumen' => 'Resumen de la ficha 1',
        ]);

        
        Role::create([
            'name' => 'ADMIN',
            'guard_name' => 'web',
        ]);
        
        $autor = Autor::find(1);
        $ficha = Ficha::find(1);
        $autor->ficha()->attach($ficha->id);
    }
}
