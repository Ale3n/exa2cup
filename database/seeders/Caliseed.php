<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Calificacion;
use App\Models\GrupoMateria;
use App\Models\InscripcionGrupo;

class Caliseed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $inscripciones = InscripcionGrupo::all();

        foreach ($inscripciones as $inscripcion) {
            $materias = GrupoMateria::where('grupo_id', $inscripcion->grupo_id)->get();

            foreach ($materias as $materia) {
                for ($numeroExamen = 1; $numeroExamen <= 3; $numeroExamen++) {
                    Calificacion::updateOrCreate(
                        [
                            'inscripcion_grupo_id' => $inscripcion->id,
                            'materia_id' => $materia->materia_id,
                            'numero_examen' => $numeroExamen,
                        ],
                        [
                            'nota' => $this->generarNota($inscripcion->id, $materia->materia_id, $numeroExamen),
                        ]
                    );
                }
            }
        }
    }

    /**
     * Genera una nota de ejemplo para la calificación.
     */
    private function generarNota(int $inscripcionId, int $materiaId, int $numeroExamen): float
    {
        $base = 55 + ($materiaId % 4) * 5 + ($inscripcionId % 3) * 2;
        $ajuste = ($numeroExamen - 1) * 4;
        return min(100, $base + $ajuste);
    }
}
