<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Personal;
use App\Models\Postulante;
use App\Models\User;

class Primfildocente extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //matematicas
        $personalUser = User::firstOrCreate(
            ['email' => 'jose.docente@example.com'],
            [
                'name' => 'Jose Docente',
                'password' => Hash::make('Docente123!'),
                'email_verified_at' => now('America/La_Paz'),
            ]
        );
        $personalUser->assignRole('DOCENTE');

        Personal::firstOrCreate(
            ['user_id' => $personalUser->id],
            [
                'tipo' => 'docente',
                'nombres' => 'Jose',
                'apellidos' => 'Perez',
                'ci' => '1234567',
                'fecha_nacimiento' => '1980-05-15',
                'telefono' => '76543210',
                'direccion' => 'Av. Siempre Viva 123',
                'profesion' => 'Matematicas',
                'es_profesional_area' => true,
                'tiene_maestria' => true,
                'tiene_diplomado_educ_superior' => true,
            ]
        );


        // Docente de Física
        $docenteFisica = User::firstOrCreate(
            ['email' => 'carlos.fisica@example.com'],
            [
                'name' => 'Carlos Fisica',
                'password' => Hash::make('Docente123!'),
                'email_verified_at' => now('America/La_Paz'),
            ]
        );
        $docenteFisica->assignRole('DOCENTE');

        Personal::firstOrCreate(
            ['user_id' => $docenteFisica->id],
            [
                'tipo' => 'docente',
                'nombres' => 'Carlos',
                'apellidos' => 'Silva',
                'ci' => '2345678',
                'fecha_nacimiento' => '1978-03-20',
                'telefono' => '77654321',
                'direccion' => 'Av. Segundo Anillo 789',
                'profesion' => 'Fisica',
                'es_profesional_area' => true,
                'tiene_maestria' => true,
                'tiene_diplomado_educ_superior' => true,
            ]
        );

        // Docente de Programación
        $docenteProgramacion = User::firstOrCreate(
            ['email' => 'maria.programacion@example.com'],
            [
                'name' => 'Maria Programacion',
                'password' => Hash::make('Docente123!'),
                'email_verified_at' => now('America/La_Paz'),
            ]
        );
        $docenteProgramacion->assignRole('DOCENTE');

        Personal::firstOrCreate(
            ['user_id' => $docenteProgramacion->id],
            [
                'tipo' => 'docente',
                'nombres' => 'Maria',
                'apellidos' => 'Rodriguez',
                'ci' => '3456789',
                'fecha_nacimiento' => '1982-07-10',
                'telefono' => '72345678',
                'direccion' => 'Calle Murillo 321',
                'profesion' => 'Programacion',
                'es_profesional_area' => true,
                'tiene_maestria' => true,
                'tiene_diplomado_educ_superior' => true,
            ]
        );

        // Docente de Inglés
        $docenteIngles = User::firstOrCreate(
            ['email' => 'pedro.ingles@example.com'],
            [
                'name' => 'Pedro Ingles',
                'password' => Hash::make('Docente123!'),
                'email_verified_at' => now('America/La_Paz'),
            ]
        );
        $docenteIngles->assignRole('DOCENTE');

        Personal::firstOrCreate(
            ['user_id' => $docenteIngles->id],
            [
                'tipo' => 'docente',
                'nombres' => 'Pedro',
                'apellidos' => 'Martinez',
                'ci' => '4567890',
                'fecha_nacimiento' => '1985-11-08',
                'telefono' => '73456789',
                'direccion' => 'Av. Arce 654',
                'profesion' => 'Ingles',
                'es_profesional_area' => true,
                'tiene_maestria' => true,
                'tiene_diplomado_educ_superior' => true,
            ]
        );

        // ==========================================
        // DOCENTES ADICIONALES
        // ==========================================

        // 2do Docente de Matemáticas
        $docenteMatematicas2 = User::firstOrCreate(
            ['email' => 'ana.matematicas@example.com'],
            [
                'name' => 'Ana Matematicas',
                'password' => Hash::make('Docente123!'),
                'email_verified_at' => now('America/La_Paz'),
            ]
        );
        $docenteMatematicas2->assignRole('DOCENTE');

        Personal::firstOrCreate(
            ['user_id' => $docenteMatematicas2->id],
            [
                'tipo' => 'docente',
                'nombres' => 'Ana',
                'apellidos' => 'Gomez',
                'ci' => '5678901',
                'fecha_nacimiento' => '1988-04-25',
                'telefono' => '71234567',
                'direccion' => 'Calle Ballivian 456',
                'profesion' => 'Matematicas',
                'es_profesional_area' => true,
                'tiene_maestria' => true,
                'tiene_diplomado_educ_superior' => true,
            ]
        );

        // 2do Docente de Física
        $docenteFisica2 = User::firstOrCreate(
            ['email' => 'luis.fisica@example.com'],
            [
                'name' => 'Luis Fisica',
                'password' => Hash::make('Docente123!'),
                'email_verified_at' => now('America/La_Paz'),
            ]
        );
        $docenteFisica2->assignRole('DOCENTE');

        Personal::firstOrCreate(
            ['user_id' => $docenteFisica2->id],
            [
                'tipo' => 'docente',
                'nombres' => 'Luis',
                'apellidos' => 'Fernandez',
                'ci' => '6789012',
                'fecha_nacimiento' => '1981-09-12',
                'telefono' => '75432109',
                'direccion' => 'Av. Bush 987',
                'profesion' => 'Fisica',
                'es_profesional_area' => true,
                'tiene_maestria' => true,
                'tiene_diplomado_educ_superior' => true,
            ]
        );

        // 2do Docente de Programación
        $docenteProgramacion2 = User::firstOrCreate(
            ['email' => 'jorge.programacion@example.com'],
            [
                'name' => 'Jorge Programacion',
                'password' => Hash::make('Docente123!'),
                'email_verified_at' => now('America/La_Paz'),
            ]
        );
        $docenteProgramacion2->assignRole('DOCENTE');

        Personal::firstOrCreate(
            ['user_id' => $docenteProgramacion2->id],
            [
                'tipo' => 'docente',
                'nombres' => 'Jorge',
                'apellidos' => 'Villca',
                'ci' => '7890123',
                'fecha_nacimiento' => '1986-12-05',
                'telefono' => '78901234',
                'direccion' => 'Calle Linares 150',
                'profesion' => 'Programacion',
                'es_profesional_area' => true,
                'tiene_maestria' => true,
                'tiene_diplomado_educ_superior' => true,
            ]
        );

        // 2do Docente de Inglés
        $docenteIngles2 = User::firstOrCreate(
            ['email' => 'elena.ingles@example.com'],
            [
                'name' => 'Elena Ingles',
                'password' => Hash::make('Docente123!'),
                'email_verified_at' => now('America/La_Paz'),
            ]
        );
        $docenteIngles2->assignRole('DOCENTE');

        Personal::firstOrCreate(
            ['user_id' => $docenteIngles2->id],
            [
                'tipo' => 'docente',
                'nombres' => 'Elena',
                'apellidos' => 'Torres',
                'ci' => '8901234',
                'fecha_nacimiento' => '1990-02-18',
                'telefono' => '70123456',
                'direccion' => 'Av. San Martin 333',
                'profesion' => 'Ingles',
                'es_profesional_area' => true,
                'tiene_maestria' => true,
                'tiene_diplomado_educ_superior' => true,
            ]
        );
    }
}
