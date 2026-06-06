<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InscripcionGrupo;
use App\Models\Grupo;
use App\Models\Materia;

class ReporteController extends Controller
{
    public function index()
    {
        return view('admin.reportes.index');
    }

    public function aprobados()
    {
        $inscripciones = InscripcionGrupo::with(['postulante', 'grupo'])->get();

        // Preparar debug para cada inscripción para entender por qué aparece como REPROBADO
        $debug = [];

        foreach ($inscripciones as $inscripcion) {
            $materias = \App\Models\GrupoMateria::where('grupo_id', $inscripcion->grupo_id)->with('materia')->get();
            $materiasCount = $materias->count();
            $materiasInfo = [];
            foreach ($materias as $m) {
                $nota = $inscripcion->notaFinalMateria($m->materia_id);
                $materiasInfo[] = [
                    'materia_id' => $m->materia_id,
                    'nombre' => $m->materia->nombre ?? null,
                    'nota' => $nota,
                    'aprobo' => $inscripcion->aproboMateria($m->materia_id),
                ];
            }

            $debug[$inscripcion->id] = [
                'grupo_id' => $inscripcion->grupo_id,
                'materias_count' => $materiasCount,
                'materias' => $materiasInfo,
                'promedio' => $inscripcion->promedioGeneral(),
                'estado' => $inscripcion->estadoFinal(),
            ];
        }

        $aprobados = $inscripciones->filter(function ($inscripcion) {
            return $inscripcion->estadoFinal() == 'APROBADO';
        });

        return view(
            'admin.reportes.aprobados',
            compact('aprobados', 'debug')
        );
    }

    public function reprobados()
    {
        $inscripciones = InscripcionGrupo::all();

        $reprobados = $inscripciones->filter(function ($inscripcion) {

            return $inscripcion->estadoFinal() == 'REPROBADO';
        });

        return view(
            'admin.reportes.reprobados',
            compact('reprobados')
        );
    }

    public function promedios()
    {
        $inscripciones = InscripcionGrupo::all();

        return view(
            'admin.reportes.promedios',
            compact('inscripciones')
        );
    }

    public function estadisticasMateria()
    {
        $materias = Materia::all();

        $estadisticas = [];

        foreach ($materias as $materia) {
            // Encontrar todos los grupos que tienen esta materia
            $grupoMaterias = \App\Models\GrupoMateria::where('materia_id', $materia->id)->pluck('grupo_id');

            // Encontrar todas las inscripciones en esos grupos
            $inscripciones = InscripcionGrupo::whereIn('grupo_id', $grupoMaterias)->get();

            $cantidad_estudiantes = $inscripciones->count();
            $aprobados = 0;
            $reprobados = 0;
            $suma_notas = 0;

            foreach ($inscripciones as $inscripcion) {
                $nota = $inscripcion->notaFinalMateria($materia->id);
                $suma_notas += $nota;

                if ($inscripcion->aproboMateria($materia->id)) {
                    $aprobados++;
                } else {
                    $reprobados++;
                }
            }

            $promedio = $cantidad_estudiantes > 0 ? $suma_notas / $cantidad_estudiantes : 0;

            $estadisticas[] = [
                'materia' => $materia->nombre,
                'cantidad_estudiantes' => $cantidad_estudiantes,
                'promedio' => number_format($promedio, 2),
                'aprobados' => $aprobados,
                'reprobados' => $reprobados,
            ];
        }

        return view(
            'admin.reportes.estadisticas_materia',
            compact('estadisticas')
        );
    }

    public function docentesGrupo()
    {
        return view(
            'admin.reportes.docentes_grupo'
        );
    }

    public function gruposAprobados()
    {
        return view(
            'admin.reportes.grupos_aprobados'
        );
    }

    public function gruposHabilitados()
    {
        $grupos = Grupo::all();

        $cantidadGrupos = $grupos->count();

        return view(
            'admin.reportes.grupos_habilitados',
            compact('grupos', 'cantidadGrupos')
        );
    }
}
