@extends('adminlte::page')

@section('content_header')
    <h1><b>Lista General de Postulantes</b></h1>
    <hr>
@stop

@section('content')

<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">Postulantes Registrados</h3>
    </div>

    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Nro</th>
                    <th>Nombre completo</th>
                    <th>CI</th>
                    <th>Correo</th>
                    <th>Teléfono</th>
                    <th>Carrera 1</th>
                    <th>Carrera 2</th>
                </tr>
            </thead>
            <tbody>
                @foreach($postulantes as $postulante)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $postulante->apellidos }} {{ $postulante->nombres }}</td>
                        <td>{{ $postulante->ci }}</td>
                        <td>{{ $postulante->usuario->email ?? '-' }}</td>
                        <td>{{ $postulante->telefono }}</td>
                        <td>{{ $postulante->carreraPrimera->nombre ?? '-' }}</td>
                        <td>{{ $postulante->carreraSegunda->nombre ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@stop
