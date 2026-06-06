<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InscripcionGrupo extends Model
{
    public function postulante()
    {
        return $this->belongsTo(Postulante::class);
    }

    public function grupo()
    {
        return $this->belongsTo(Grupo::class);
    }

    public function notaFinalMateria($materiaId)
    {
        // La nota final por materia se calcula con ponderaciones:
        // examen 1 -> 30%, examen 2 -> 30%, examen 3 -> 40%.
        $e1 = Calificacion::where('inscripcion_grupo_id', $this->id)
            ->where('materia_id', $materiaId)
            ->where('numero_examen', 1)
            ->value('nota') ?? 0;

        $e2 = Calificacion::where('inscripcion_grupo_id', $this->id)
            ->where('materia_id', $materiaId)
            ->where('numero_examen', 2)
            ->value('nota') ?? 0;

        $e3 = Calificacion::where('inscripcion_grupo_id', $this->id)
            ->where('materia_id', $materiaId)
            ->where('numero_examen', 3)
            ->value('nota') ?? 0;

        return ($e1 * 0.30) + ($e2 * 0.30) + ($e3 * 0.40);
    }

    /**
     * Determina si el alumno aprobó una materia (suma de 3 examenes > 60)
     */
    public function aproboMateria($materiaId)
    {
        // Considerar aprobado si la nota ponderada es >= 60
        return $this->notaFinalMateria($materiaId) >= 60;
    }

    public function promedioGeneral()
    {
        $materias = GrupoMateria::where(
            'grupo_id',
            $this->grupo_id
        )->get();
        $suma = 0;

        foreach ($materias as $materia) {
            $suma += $this->notaFinalMateria(
                $materia->materia_id
            );
        }

        // Si no hay materias, evitar división por cero
        if ($materias->count() === 0) {
            return 0;
        }

        // Promedio según la suma de las notas por materia
        return $suma / $materias->count();
    }
    public function estadoFinal()
    {
        $materias = GrupoMateria::where('grupo_id', $this->grupo_id)->get();

        // Requerimiento: debe existir exactamente 4 materias en el grupo
        if ($materias->count() !== 4) {
            return 'REPROBADO';
        }

        // Debe aprobarse cada materia (suma de 3 examenes > 60)
        foreach ($materias as $materia) {
            if (! $this->aproboMateria($materia->materia_id)) {
                return 'REPROBADO';
            }
        }

        // Si aprobó las 4 materias, calcular promedio (suma por materia / 4)
        $promedio = $this->promedioGeneral();

        return $promedio >= 60 ? 'APROBADO' : 'REPROBADO';
    }
}
