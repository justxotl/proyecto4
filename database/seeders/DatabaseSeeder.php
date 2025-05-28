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
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear el rol MASTER
        $master = Role::firstOrCreate([
            'name' => 'MASTER',
            'guard_name' => 'web',
        ]);

        $admin = Role::firstOrCreate([
            'name' => 'ADMIN',
            'guard_name' => 'web',
        ]);

        $userRole = Role::firstOrCreate([
            'name' => 'USER',
            'guard_name' => 'web',
        ]);

        // Lista de permisos
        $permisos = [
            'Ver Lista de Usuarios',
            'Registrar Usuario',
            'Exportar Reporte de Usuarios',
            'Ver Información de Usuario',
            'Editar Usuario',
            'Eliminar Usuario',
            'Ver Perfil de Usuario',

            'Ver Lista de Autores',
            'Registrar Autor',
            'Exportar Reporte de Autores',
            'Editar Autor',
            'Eliminar Autor',
            'Quitar Autor de Ficha', //este podría obviarse

            'Ver Lista de Carreras',
            'Registrar Carrera',
            'Exportar Reporte de Carreras',
            'Editar Carrera',
            'Eliminar Carrera',

            'Ver Lista de Fichas',
            'Registrar Ficha',
            'Exportar Reporte de Fichas',
            'Ver Información de Ficha',
            'Exportar Reporte de Ficha Única',
            'Editar Ficha',
            'Eliminar Ficha',

            'Ver Lista de Préstamos',
            'Registrar Préstamo',
            'Exportar Reporte de Préstamos',
            'Ver Información de Préstamo',
            'Marcar Préstamo como Devuelto',
            'Editar Préstamo',
            'Eliminar Préstamo',

            'Ver Lista de Roles',
            'Registrar Rol',
            'Exportar Reporte de Roles',
            'Editar Rol',
            'Eliminar Rol',

            'Ver Lista de Respaldos',
            'Crear Respaldo',
            'Restaurar Respaldo',
            'Restaurar Respaldo desde Dispositivo',
            'Descargar Respaldo',
            'Eliminar Respaldo',

            'Ver Estadísticas del Sistema'
        ];

        // Crear permisos y asignarlos al rol MASTER
        foreach ($permisos as $permiso) {
            $perm = Permission::firstOrCreate(['name' => $permiso, 'guard_name' => 'web']);
            $perm->syncRoles([$master]);
        }

        // Crear usuario de prueba y asignarle el rol MASTER
        $user = User::factory()->create([
            'name' => 'User',
            'email' => 'test@example.com',
            'password' => Hash::make('master1234'),
        ]);

        $user->assignRole('MASTER');

        // Información personal
        infoper::create([
            'ci_us' => '12345678',
            'nombre' => 'Test',
            'apellido' => 'User',
            'user_id' => $user->id,
        ]);

        // Preguntas de recuperación
        PreguntaUser::create([
            'user_id' => $user->id,
            'pregunta_uno' => '¿Cuál es tu color favorito?',
            'pregunta_dos' => '¿Cuál es tu animal favorito?',
            'respuesta_uno' => 'Azul',
            'respuesta_dos' => 'Perro',
        ]);

        // Crear usuario ADMIN
        $adminUser = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin1234'),
        ]);

        $adminUser->assignRole('ADMIN');

        infoper::create([
            'ci_us' => '87654321',
            'nombre' => 'Admin',
            'apellido' => 'User',
            'user_id' => $adminUser->id,
        ]);

        PreguntaUser::create([
            'user_id' => $adminUser->id,
            'pregunta_uno' => '¿Dónde naciste?',
            'pregunta_dos' => '¿Cuál es tu comida favorita?',
            'respuesta_uno' => 'Caracas',
            'respuesta_dos' => 'Pizza',
        ]);

        // Crear usuario USER
        $userOnly = User::factory()->create([
            'name' => 'Usuario',
            'email' => 'usuario@example.com',
            'password' => Hash::make('usuario1234'),
        ]);

        $userOnly->assignRole('USER');

        infoper::create([
            'ci_us' => '11223344',
            'nombre' => 'Usuario',
            'apellido' => 'User',
            'user_id' => $userOnly->id,
        ]);

        PreguntaUser::create([
            'user_id' => $userOnly->id,
            'pregunta_uno' => '¿Tu primer colegio?',
            'pregunta_dos' => '¿Nombre de tu mascota?',
            'respuesta_uno' => 'San José',
            'respuesta_dos' => 'Firulais',
        ]);

        // Crear autor
        $autor = Autor::create([
            'ci_autor' => '12345678',
            'nombre_autor' => 'Registro',
            'apellido_autor' => 'De Autor',
        ]);

        // Crear carrera
        $carrera = Carrera::create([
            'nombre' => 'Ingeniería en Sistemas',
        ]);

        // Crear ficha
        $ficha = Ficha::create([
            'titulo' => 'Título 1',
            'fecha' => '2023-10-01',
            'carrera_id' => $carrera->id,
            'resumen' => 'Resumen de la ficha 1',
        ]);

        // Relacionar ficha con autor
        $autor->ficha()->attach($ficha->id);
    }
}
