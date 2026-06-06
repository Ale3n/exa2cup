@extends('adminlte::page')

@section('content_header')
    <h1><b>Reporte de Reprobados</b></h1>
    <hr>
@stop

@section('content')

<div class="card card-outline card-danger">

    <div class="card-header">
        <h3 class="card-title">
            Lista de postulantes reprobados
        </h3>
    </div>

    <div class="card-body">

        <table class="table table-bordered table-striped">

            <thead>
                <tr>
                    <th>Nro</th>
                    <th>Postulante</th>
                    <th>Promedio</th>
                    <th>Estado</th>
                </tr>
            </thead>

            <tbody>

            @foreach($reprobados as $inscripcion)

                <tr>

                    <td>{{ $loop->iteration }}</td>

                    <td>
                        {{ $inscripcion->postulante->nombres }}
                        {{ $inscripcion->postulante->apellidos }}
                    </td>

                    <td>
                        {{ number_format($inscripcion->promedioGeneral(),2) }}
                    </td>

                    <td>
                        <span class="badge badge-danger">
                            {{ $inscripcion->estadoFinal() }}
                        </span>
                    </td>

                </tr>

            @endforeach

            </tbody>

        </table>

    </div>

</div>

@stop