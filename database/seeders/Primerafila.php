<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Carrera;
use App\Models\Gestion;
use App\Models\Materia;
use App\Models\Personal;
use App\Models\Postulante;
use App\Models\User;
use App\Models\Aula;

class Primerafila extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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
                'nombre' => 'Matematicas',
            ]
        );
        Materia::firstOrCreate(
            ['codigo' => 'FIS'],
            [
                'nombre' => 'Fisica',
            ]
        );
        Materia::firstOrCreate(
            ['codigo' => 'PROG'],
            [
                'nombre' => 'Programacion',
            ]
        );
        Materia::firstOrCreate(
            ['codigo' => 'ING'],
            [
                'nombre' => 'Ingles',
            ]
        );
        Gestion::firstOrCreate(
            [
                'año' => 2026,
                'periodo' => 1,
            ],
            [
                'descripcion' => 'Gestión 2026 - Primer Periodo',
                'estado' => 'activo',
            ]
        );

        Aula::class::firstOrCreate(
            ['numero' => 10],
            [
                'capacidad' => 25,
            ]
        );
        Aula::class::firstOrCreate(
            ['numero' => 11],
            [
                'capacidad' => 25,
            ]
        );
        Aula::class::firstOrCreate(
            ['numero' => 12],
            [
                'capacidad' => 25,
            ]
        );

        

        
    }
}
