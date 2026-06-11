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
            foreach ($materias as $m) {
                $materia = Materia::where('codigo', $m['codigo'])->first();
                if (!$materia) {
                    continue;
                }

                // Buscar personales cuya profesión coincida con el nombre de la materia
                $allPersonales = Personal::all();
                $candidates = $allPersonales->filter(function ($p) use ($materia) {
                    return trim(strtolower($p->profesion)) === trim(strtolower($materia->nombre));
                });

                // Si no hay especialistas, permitir cualquier personal como último recurso
                if ($candidates->count() === 0) {
                    $candidates = $allPersonales;
                }

                $assigned = false;

                foreach ($candidates as $personal) {
                    // Respetar límite de 4 grupos distintos por docente (como en controller)
                    $gruposAsignados = GrupoMateria::where('personal_id', $personal->id)
                        ->pluck('grupo_id')
                        ->unique();

                    if (! $gruposAsignados->contains($grupo->id) && $gruposAsignados->count() >= 4) {
                        continue; // este docente ya tiene 4 grupos distintos
                    }

                    // Evitar choque de horario por docente
                    $existeChoqueDocente = GrupoMateria::where('personal_id', $personal->id)
                        ->where('hora_inicio', '<', $m['hora_fin'])
                        ->where('hora_fin', '>', $m['hora_inicio'])
                        ->exists();

                    if ($existeChoqueDocente) {
                        continue; // este docente tiene choque de horario
                    }

                    // Buscar un aula disponible (sin choque de horario)
                    $chosenAula = null;
                    foreach ($aulas as $aula) {
                        $existeChoqueAula = GrupoMateria::where('aula_id', $aula->id)
                            ->where('hora_inicio', '<', $m['hora_fin'])
                            ->where('hora_fin', '>', $m['hora_inicio'])
                            ->exists();

                        if (! $existeChoqueAula) {
                            $chosenAula = $aula;
                            break;
                        }
                    }

                    // Crear o obtener la asignación si aún no existe
                    GrupoMateria::firstOrCreate(
                        [
                            'grupo_id' => $grupo->id,
                            'materia_id' => $materia->id,
                        ],
                        [
                            'personal_id' => $personal ? $personal->id : null,
                            'aula_id' => $chosenAula ? $chosenAula->id : null,
                            'hora_inicio' => $m['hora_inicio'],
                            'hora_fin' => $m['hora_fin'],
                        ]
                    );

                    $assigned = true;
                    break; // asignada la materia para este grupo
                }

                if (! $assigned) {
                    $this->command->info('No se encontró personal/aula disponible para materia: ' . ($materia->nombre ?? $m['codigo']) . ' en grupo ' . $grupo->codigo . '.');
                }
            }
        }
    }
}
