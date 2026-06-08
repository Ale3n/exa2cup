@extends('adminlte::page')

@section('content_header')
<h1><b>Reportes</b></h1>
<hr>
@stop

@section('content')

<div class="row">

    <div class="col-md-3">
        <a href="{{ route('admin.reportes.aprobados') }}"
            class="btn btn-success btn-block">
            Aprobados
        </a>
    </div>

    <div class="col-md-3">
        <a href="{{ route('admin.reportes.reprobados') }}"
            class="btn btn-danger btn-block">
            Reprobados
        </a>
    </div>

    <div class="col-md-3">
        <a href="{{ route('admin.reportes.promedios') }}"
            class="btn btn-primary btn-block">
            Promedios
        </a>
    </div>
    <div class="col-md-3">
        <a href="{{ route('admin.reportes.generalPostulantes') }}"
            class="btn btn-secondary btn-block">
            Postulantes
        </a>
    </div>
    <div class="col-md-3">
        <a href="{{ route('admin.reportes.gruposHabilitados') }}"
            class="btn btn-info btn-block">
            Grupos Habilitados
        </a>
    </div>
    <div class="col-md-3">
        <a href="{{ route('admin.reportes.gruposAprobados') }}"
            class="btn btn-dark btn-block">
            Grupos con más Aprobados
        </a>
    </div>
    <div class="col-md-3">
        <a href="{{ route('admin.reportes.docentesGrupo') }}"
            class="btn btn-primary btn-block">
            Docentes por Grupo
        </a>
    </div>
    <div class="col-md-3">
        <a href="{{ route('admin.reportes.estadisticasMateria') }}"
            class="btn btn-warning btn-block">
            Estadísticas por Materia
        </a>
    </div>

</div>

@stop