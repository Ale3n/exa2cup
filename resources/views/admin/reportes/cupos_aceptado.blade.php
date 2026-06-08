@extends('adminlte::page')

@section('content_header')
    <h1><b>Admitidos según cupo</b></h1>
    <hr>
@stop

@section('content')

<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">Resultados de admisión por carrera</h3>
    </div>

    <div class="card-body">
        <div class="mb-4">
            <h4>Admitidos a la primera carrera</h4>
            @if($admitidosPrimera->isEmpty())
                <div class="alert alert-info">No hay postulantes admitidos a primera carrera.</div>
            @else
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Nro</th>
                            <th>Postulante</th>
                            <th>CI</th>
                            <th>Promedio</th>
                            <th>Primera carrera</th>
                            <th>Segunda carrera</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($admitidosPrimera as $row)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $row['postulante']->apellidos }} {{ $row['postulante']->nombres }}</td>
                                <td>{{ $row['postulante']->ci }}</td>
                                <td>{{ number_format($row['promedio'], 2) }}</td>
                                <td>{{ $row['carreraPrimera']->nombre ?? '-' }}</td>
                                <td>{{ $row['carreraSegunda']->nombre ?? '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>

        <div>
            <h4>Admitidos a la segunda carrera</h4>
            @if($admitidosSegunda->isEmpty())
                <div class="alert alert-info">No hay postulantes admitidos a segunda carrera.</div>
            @else
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Nro</th>
                            <th>Postulante</th>
                            <th>CI</th>
                            <th>Promedio</th>
                            <th>Primera carrera</th>
                            <th>Segunda carrera</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($admitidosSegunda as $row)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $row['postulante']->apellidos }} {{ $row['postulante']->nombres }}</td>
                                <td>{{ $row['postulante']->ci }}</td>
                                <td>{{ number_format($row['promedio'], 2) }}</td>
                                <td>{{ $row['carreraPrimera']->nombre ?? '-' }}</td>
                                <td>{{ $row['carreraSegunda']->nombre ?? '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>

@stop
