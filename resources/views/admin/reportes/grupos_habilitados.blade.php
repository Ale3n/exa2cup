@extends('adminlte::page')

@section('content_header')
    <h1><b>Grupos Habilitados</b></h1>
    <hr>
@stop

@section('content')

<div class="row">

    <div class="col-md-4">

        <div class="small-box bg-info">

            <div class="inner">
                <h3>{{ $cantidadGrupos }}</h3>
                <p>Total de grupos habilitados</p>
            </div>

            <div class="icon">
                <i class="fas fa-users"></i>
            </div>

        </div>

    </div>

</div>

<div class="card card-outline card-primary">

    <div class="card-header">
        <h3 class="card-title">
            Lista de grupos
        </h3>
    </div>

    <div class="card-body">

        <table class="table table-bordered table-striped">

            <thead>
                <tr>
                    <th>Nro</th>
                    <th>Código</th>
                    <th>Días</th>
                    <th>Modalidad</th>
                    <th>Inscritos</th>
                    <th>Gestión</th>
                </tr>
            </thead>

            <tbody>

            @foreach($grupos as $grupo)

                <tr>

                    <td>{{ $loop->iteration }}</td>

                    <td>{{ $grupo->codigo }}</td>

                    <td>{{ $grupo->dias }}</td>

                    <td>{{ $grupo->modalidad }}</td>

                    <td>{{ $grupo->inscritos }}</td>

                    <td>
                        {{ $grupo->gestion->anio ?? '' }}
                    </td>

                </tr>

            @endforeach

            </tbody>

        </table>

    </div>

</div>

@stop