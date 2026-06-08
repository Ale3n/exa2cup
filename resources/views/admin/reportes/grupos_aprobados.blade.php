@extends('adminlte::page')

@section('content_header')
    <h1><b>Grupos con más aprobados por gestión</b></h1>
    <hr>
@stop

@section('content')

<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">Resumen por Gestión</h3>
    </div>

    <div class="card-body">
        @if($topGroupsByGestion->isEmpty())
            <div class="alert alert-info">
                No hay datos de inscripciones o aprobados para mostrar.
            </div>
        @else
            @foreach($topGroupsByGestion as $row)
                @php
                    $grupo = $row['grupo'];
                    $gestion = $row['gestion'];
                @endphp

                <div class="card card-secondary mb-4">
                    <div class="card-header">
                        <h4 class="card-title">
                            Gestión {{ $gestion->anio ?? 'N/A' }}
                        </h4>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Grupo</th>
                                    <th>Días</th>
                                    <th>Modalidad</th>
                                    <th>Total inscritos</th>
                                    <th>Aprobados</th>
                                    <th>Porcentaje aprobados</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $grupo->codigo ?? 'N/A' }}</td>
                                    <td>{{ $grupo->dias ?? '-' }}</td>
                                    <td>{{ ucfirst($grupo->modalidad ?? '-') }}</td>
                                    <td>{{ $row['total_inscritos'] }}</td>
                                    <td>{{ $row['approved_count'] }}</td>
                                    <td>
                                        {{ $row['total_inscritos'] > 0 ? number_format(($row['approved_count'] / $row['total_inscritos']) * 100, 2) . '%' : '0%' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>

@stop
