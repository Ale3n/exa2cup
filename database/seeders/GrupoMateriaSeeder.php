<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Grupo;
use App\Models\Gestion;
use App\Models\Materia;
use App\Models\Personal;
use App\Models\Aula;
use App\Models\GrupoMateria;

class GrupoMateriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $gestion = Gestion::first();

        // Crear los dos grupos iniciales
        $grupoSX = Grupo::firstOrCreate(
            ['codigo' => 'SX'],
            [
                'gestion_id' => $gestion ? $gestion->id : null,
                'dias' => 'Lunes a Viernes',
                'modalidad' => 'presencial',
                'inscritos' => 0,
            ]
        );

        $grupoST = Grupo::firstOrCreate(
            ['codigo' => 'ST'],
            [
                'gestion_id' => $gestion ? $gestion->id : null,
                'dias' => 'Lunes a Viernes',
                'modalidad' => 'presencial',
                'inscritos' => 0,
            ]
        );

        // Obtener todas las aulas disponibles
        $aulas = Aula::all();

        // Definir las materias con sus horarios
        $materias = [
            ['codigo' => 'MAT', 'profesion' => 'Matematicas', 'hora_inicio' => '08:00:00', 'hora_fin' => '10:00:00'],
            ['codigo' => 'FIS', 'profesion' => 'Fisica', 'hora_inicio' => '10:00:00', 'hora_fin' => '12:00:00'],
            ['codigo' => 'PROG', 'profesion' => 'Programacion', 'hora_inicio' => '14:00:00', 'hora_fin' => '16:00:00'],
            ['codigo' => 'ING', 'profesion' => 'Ingles', 'hora_inicio' => '16:00:00', 'hora_fin' => '18:00:00'],
        ];

        // Obtener todos los grupos existentes
        $grupos = Grupo::all();

        // Para cada grupo, asignar las 4 materias
        foreach ($grupos as $grupoIndex => $grupo) {
            // Asignar un aula específica a cada grupo (ciclando entre las aulas disponibles)
            $aula = null;
            if ($aulas->count() > 0) {
                $aula = $aulas[$grupoIndex % $aulas->count()];
            }

            foreach ($materias as $m) {
                $materia = Materia::where('codigo', $m['codigo'])->first();
                if (!$materia) {
                    continue;
                }

                // Buscar un personal con la profesión relacionada, si no existe tomar el primero disponible
                $personal = Personal::where('profesion', $m['profesion'])->first();
                if (!$personal) {
                    $personal = Personal::first();
                }

                GrupoMateria::firstOrCreate(
                    [
                        'grupo_id' => $grupo->id,
                        'materia_id' => $materia->id,
                    ],
                    [
                        'personal_id' => $personal ? $personal->id : null,
                        'aula_id' => $aula ? $aula->id : null,
                        'hora_inicio' => $m['hora_inicio'],
                        'hora_fin' => $m['hora_fin'],
                    ]
                );
            }
        }
    }
}
