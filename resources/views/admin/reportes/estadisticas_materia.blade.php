@extends('adminlte::page')

@section('content_header')
    <h1><b>Estadísticas por Materia</b></h1>
@stop

@section('content')

<div class="card card-outline card-primary">

    <div class="card-body">

        <table class="table table-bordered">

            <thead>

                <tr>
                    <th>Materia</th>
                    <th>Estudiantes</th>
                    <th>Promedio</th>
                    <th>Aprobados</th>
                    <th>Reprobados</th>
                </tr>

            </thead>

            <tbody>

            @foreach($estadisticas as $dato)

                <tr>

                    <td>{{ $dato['materia'] }}</td>

                    <td>{{ $dato['cantidad_estudiantes'] }}</td>

                    <td>{{ $dato['promedio'] }}</td>

                    <td>{{ $dato['aprobados'] }}</td>

                    <td>{{ $dato['reprobados'] }}</td>

                </tr>

            @endforeach

            </tbody>

        </table>

    </div>

</div>

@stop