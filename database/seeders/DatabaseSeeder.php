<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\RoleSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Carrera;
use App\Models\Materia;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);

        // User::factory(10)->create();

        $admin = User::firstOrCreate(
            ['email' => 'dylancossioaguilera@gmail.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('12345678Aa'),
                'email_verified_at' => now('America/La_Paz'),
            ]
        );
        $admin->assignRole('ADMINISTRADOR');

        //1. Ingeniería en Sistemas
        Carrera::firstOrCreate(
            ['codigo' => '187-4'], // Condición de búsqueda (llave única)
            [
                'nombre' => 'Ingeniería en Sistemas',
                'capacidad' => 30,
                'estado' => 'activo'
            ]
        );

        // 2. Ingeniería Informática
        Carrera::firstOrCreate(
            ['codigo' => '187-3'],
            [
                'nombre' => 'Ingeniería Informática',
                'capacidad' => 30,
                'estado' => 'activo'
            ]
        );

        // 3. Ingeniería en Robótica
        Carrera::firstOrCreate(
            ['codigo' => '323-0'],
            [
                'nombre' => 'Ingeniería en Robótica',
                'capacidad' => 30,
                'estado' => 'activo'
            ]
        );

        // 4. Ingeniería en Redes y Telecomunicaciones
        Carrera::firstOrCreate(
            ['codigo' => '187-5'],
            [
                'nombre' => 'Ingeniería en Redes y Telecomunicaciones',
                'capacidad' => 30,
                'estado' => 'activo'
            ]
        );

        Materia::firstOrCreate(
            ['codigo' => 'MAT'],
            [
                'nombre' => 'Matemáticas',
            ]
        );
        Materia::firstOrCreate(
            ['codigo' => 'FIS'],
            [
                'nombre' => 'Física',
            ]
        );
        Materia::firstOrCreate(
            ['codigo' => 'PROG'],
            [
                'nombre' => 'Programación',
            ]
        );
        Materia::firstOrCreate(
            ['codigo' => 'ING'],
            [
                    'nombre' => 'Ingles',
            ]
        );
            






    }
}
