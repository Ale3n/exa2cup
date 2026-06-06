@extends('adminlte::page')

@section('content_header')
<h1><b>Reporte de Aprobados</b></h1>
<hr>
@stop

@section('content')

<div class="card card-outline card-success">

    <div class="card-header">
        <h3 class="card-title">
            Lista de postulantes aprobados
        </h3>
    </div>

    <div class="card-body">

        <table class="table table-bordered">

            <thead>
                <tr>
                    <th>Nro</th>
                    <th>Postulante</th>
                    <th>Promedio</th>
                    <th>Estado</th>
                    <th>Detalles</th>
                </tr>
            </thead>

            <tbody>

                @foreach($aprobados as $inscripcion)

                <tr>

                    <td>{{ $loop->iteration }}</td>

                    <td>
                        {{ $inscripcion->postulante->nombres }}
                        {{ $inscripcion->postulante->apellidos }}
                    </td>

                    <td>
                        {{ number_format($inscripcion->promedioGeneral(), 2) }}
                    </td>

                    <td>
                        {{ $inscripcion->estadoFinal() }}
                    </td>

                    @if(isset($debug) && isset($debug[$inscripcion->id]))
                    <td>
                        <small>Grupo ID: {{ $debug[$inscripcion->id]['grupo_id'] }} | Materias: {{ $debug[$inscripcion->id]['materias_count'] }} | Prom: {{ number_format($debug[$inscripcion->id]['promedio'],2) }} | Estado: {{ $debug[$inscripcion->id]['estado'] }}</small>
                        <ul>
                        @foreach($debug[$inscripcion->id]['materias'] as $m)
                            <li>{{ $m['nombre'] ?? 'ID '.$m['materia_id'] }}: {{ number_format($m['nota'],2) }} - {{ $m['aprobo'] ? 'APROB' : 'REPR' }}</li>
                        @endforeach
                        </ul>
                    </td>
                    @endif

                </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>

@stop