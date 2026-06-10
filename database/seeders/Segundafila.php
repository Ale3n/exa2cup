<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Gestion;
use App\Models\Grupo;
use App\Models\Aula;
use App\Models\Materia;
use App\Models\Personal;
use App\Models\GrupoMateria;
use App\Models\Postulante;
use App\Models\InscripcionGrupo;

class Segundafila extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener los dos primeros grupos (por id)
        $groups = Grupo::orderBy('id')->take(2)->get();

        if ($groups->count() < 2) {
            $this->command->info('Se requieren al menos 2 grupos en la tabla `grupos`.');
            return;
        }

        // Tomar hasta 50 postulantes (aleatoriamente si hay más)
        $postulantes = Postulante::inRandomOrder()->take(50)->get();

        if ($postulantes->count() === 0) {
            $this->command->info('No hay postulantes disponibles para inscribir.');
            return;
        }

        // Asignar 25 a cada grupo (si hay menos de 50, repartir equitativamente)
        $perGroup = 25;
        $i = 0;
        foreach ($postulantes as $postulante) {
            $groupIndex = ($i < $perGroup) ? 0 : 1;
            $grupoId = $groups[$groupIndex]->id;

            // Evitar duplicados: si ya existe, saltar
            $exists = InscripcionGrupo::where('postulante_id', $postulante->id)
                ->where('grupo_id', $grupoId)
                ->exists();

            if (! $exists) {
                $ins = new InscripcionGrupo();
                $ins->postulante_id = $postulante->id;
                $ins->grupo_id = $grupoId;
                $ins->fecha_eleccion = date('Y-m-d');
                $ins->save();
            }

            $i++;
            // Si ya asignamos 50 postulantes, terminar
            if ($i >= ($perGroup * 2)) {
                break;
            }
        }
        $this->command->info('Seeder Segundafila: inscripciones procesadas.');
    }

    
}
