<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InscripcionGrupo;
use App\Models\Grupo;
use App\Models\Materia;
use App\Models\GrupoMateria;
use App\Models\Postulante;

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

    public function generalPostulantes()
    {
        $postulantes = Postulante::with([
            'usuario',
            'carreraPrimera',
            'carreraSegunda'
        ])->orderBy('apellidos')->get();

        return view(
            'admin.reportes.generalpostu',
            compact('postulantes')
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
        $grupoMaterias = GrupoMateria::with([
            'grupo.gestion',
            'materia',
            'personal'
        ])->get();

        $grupoMateriasGrouped = $grupoMaterias->groupBy('grupo_id');

        return view(
            'admin.reportes.docentes_grupo',
            compact('grupoMateriasGrouped')
        );
    }

    public function gruposAprobados()
    {
        $inscripciones = InscripcionGrupo::with(['grupo.gestion'])->get();

        $groupStats = [];

        foreach ($inscripciones as $inscripcion) {
            $grupo = $inscripcion->grupo;

            if (! $grupo) {
                continue;
            }

            $groupId = $grupo->id;

            if (! isset($groupStats[$groupId])) {
                $groupStats[$groupId] = [
                    'grupo' => $grupo,
                    'gestion' => $grupo->gestion,
                    'approved_count' => 0,
                    'total_inscritos' => 0,
                ];
            }

            $groupStats[$groupId]['total_inscritos']++;

            if ($inscripcion->estadoFinal() === 'APROBADO') {
                $groupStats[$groupId]['approved_count']++;
            }
        }

        $groupsByGestion = collect($groupStats)
            ->groupBy(fn ($group) => $group['gestion']->id ?? 0)
            ->map(fn ($groups) => $groups->sortByDesc('approved_count'));

        $topGroupsByGestion = $groupsByGestion->map(fn ($groups) => $groups->first());

        return view(
            'admin.reportes.grupos_aprobados',
            compact('topGroupsByGestion')
        );
    }

    public function cuposAceptados()
    {
        $inscripciones = InscripcionGrupo::with([
            'postulante.carreraPrimera',
            'postulante.carreraSegunda',
            'grupo'
        ])->get();

        $candidatos = $inscripciones->filter(function ($inscripcion) {
            return $inscripcion->postulante &&
                $inscripcion->postulante->carreraPrimera &&
                $inscripcion->estadoFinal() === 'APROBADO';
        })->map(function ($inscripcion) {
            return [
                'inscripcion' => $inscripcion,
                'postulante' => $inscripcion->postulante,
                'promedio' => $inscripcion->promedioGeneral(),
                'carreraPrimera' => $inscripcion->postulante->carreraPrimera,
                'carreraSegunda' => $inscripcion->postulante->carreraSegunda,
            ];
        });

        $admitidosPrimera = collect();
        $rechazadosPrimera = collect();

        foreach ($candidatos->groupBy(fn ($row) => $row['carreraPrimera']->id) as $grupoId => $grupo) {
            $capacidad = $grupo->first()['carreraPrimera']->capacidad ?? 0;
            $ordenados = $grupo->sortByDesc('promedio')->values();

            $admitidosPrimera = $admitidosPrimera->concat($ordenados->take($capacidad));
            $rechazadosPrimera = $rechazadosPrimera->concat($ordenados->slice($capacidad));
        }

        $admitidosSegunda = collect();

        foreach ($rechazadosPrimera->groupBy(fn ($row) => optional($row['carreraSegunda'])->id) as $segId => $grupo) {
            $carreraSegunda = $grupo->first()['carreraSegunda'];

            if (! $carreraSegunda) {
                continue;
            }

            $capacidadSegunda = $carreraSegunda->capacidad ?? 0;
            $ordenadosSegunda = $grupo->sortByDesc('promedio')->values();

            $admitidosSegunda = $admitidosSegunda->concat($ordenadosSegunda->take($capacidadSegunda));
        }

        return view(
            'admin.reportes.cupos_aceptado',
            compact('admitidosPrimera', 'admitidosSegunda')
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
