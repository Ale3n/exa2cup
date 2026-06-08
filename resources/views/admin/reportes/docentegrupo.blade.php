@extends('adminlte::page')

@section('content_header')
    <h1><b>Docentes por Grupo</b></h1>
    <hr>
@stop

@section('content')

<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">Asignaciones de Docentes</h3>
    </div>

    <div class="card-body">
        @if($grupoMateriasGrouped->isEmpty())
            <div class="alert alert-info">
                No hay docentes asignados a ningún grupo.
            </div>
        @else
            @foreach($grupoMateriasGrouped as $grupoId => $asignaciones)
                @php
                    $grupo = $asignaciones->first()->grupo;
                    $docentesPorGrupo = $asignaciones->groupBy('personal_id');
                @endphp

                <div class="card card-secondary mb-4">
                    <div class="card-header">
                        <h4 class="card-title">
                            Grupo {{ $grupo->codigo ?? 'ID ' . $grupoId }}
                            @if($grupo->gestion)
                                - Gestión {{ $grupo->gestion->anio }}
                            @endif
                        </h4>
                    </div>

                    <div class="card-body">
                        <p>
                            <strong>Días:</strong> {{ $grupo->dias ?? '-' }}
                            &nbsp;|&nbsp;
                            <strong>Modalidad:</strong> {{ ucfirst($grupo->modalidad ?? '-') }}
                        </p>

                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nro</th>
                                    <th>Docente</th>
                                    <th>Profesión</th>
                                    <th>Materias asignadas</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($docentesPorGrupo as $personalId => $asignacionesDocente)
                                    @php
                                        $docente = $asignacionesDocente->first()->personal;
                                        $materias = $asignacionesDocente->pluck('materia.nombre')->filter()->unique()->values();
                                    @endphp
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $docente->nombres ?? '-' }} {{ $docente->apellidos ?? '' }}</td>
                                        <td>{{ $docente->profesion ?? '-' }}</td>
                                        <td>{{ $materias->isNotEmpty() ? $materias->join(', ') : '-' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>

@stop
