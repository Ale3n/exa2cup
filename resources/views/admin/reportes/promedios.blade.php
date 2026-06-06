@extends('adminlte::page')

@section('content_header')
    <h1><b>Promedios Generales</b></h1>
    <hr>
@stop

@section('content')

<div class="card card-outline card-primary">

    <div class="card-header">
        <h3 class="card-title">
            Promedios de todos los postulantes
        </h3>
    </div>

    <div class="card-body">

        <table class="table table-bordered table-striped">

            <thead>
                <tr>
                    <th>Nro</th>
                    <th>Postulante</th>
                    <th>Grupo</th>
                    <th>Promedio</th>
                    <th>Estado</th>
                </tr>
            </thead>

            <tbody>

            @foreach($inscripciones as $inscripcion)

                <tr>

                    <td>{{ $loop->iteration }}</td>

                    <td>
                        {{ $inscripcion->postulante->nombres }}
                        {{ $inscripcion->postulante->apellidos }}
                    </td>

                    <td>
                        {{ $inscripcion->grupo->codigo ?? 'N/A' }}
                    </td>

                    <td>
                        {{ number_format($inscripcion->promedioGeneral(), 2) }}
                    </td>

                    <td>

                        @if($inscripcion->estadoFinal() == 'APROBADO')

                            <span class="badge badge-success">
                                APROBADO
                            </span>

                        @else

                            <span class="badge badge-danger">
                                REPROBADO
                            </span>

                        @endif

                    </td>

                </tr>

            @endforeach

            </tbody>

        </table>

    </div>

</div>

@stop