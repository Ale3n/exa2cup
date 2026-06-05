@extends('adminlte::page')

@section('content_header')
    <h1>Datos del Personal {{ ucfirst($personal->tipo) }}</h1>
    <hr>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">

        <div class="card card-info">

            <div class="card-header">
                <h3 class="card-title">Datos Registrados</h3>
            </div>

            <div class="card-body">

                <div class="row">

                    <div class="col-md-12">

                        <div class="row">

                            <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                                <div class="form-group">
                                    <label>Nombre del rol</label><b> (*)</b>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-user-check"></i>
                                            </span>
                                        </div>

                                        <input type="text"
                                               class="form-control"
                                               value="{{ $personal->usuario->roles->pluck('name')->implode(', ') }}"
                                               disabled>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                                <div class="form-group">
                                    <label>Nombres</label><b> (*)</b>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-user"></i>
                                            </span>
                                        </div>

                                        <input type="text"
                                               class="form-control"
                                               value="{{ $personal->nombres }}"
                                               disabled>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                                <div class="form-group">
                                    <label>Apellidos</label><b> (*)</b>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-user-friends"></i>
                                            </span>
                                        </div>

                                        <input type="text"
                                               class="form-control"
                                               value="{{ $personal->apellidos }}"
                                               disabled>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                                <div class="form-group">
                                    <label>Cédula de Identidad</label><b> (*)</b>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-id-card"></i>
                                            </span>
                                        </div>

                                        <input type="text"
                                               class="form-control"
                                               value="{{ $personal->ci }}"
                                               disabled>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                                <div class="form-group">
                                    <label>Fecha Nacimiento</label><b> (*)</b>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-calendar-alt"></i>
                                            </span>
                                        </div>

                                        <input type="date"
                                               class="form-control"
                                               value="{{ $personal->fecha_nacimiento }}"
                                               disabled>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-sm-6 col-md-6 col-lg-5">
                                <div class="form-group">
                                    <label>Dirección</label><b> (*)</b>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-map-marker-alt"></i>
                                            </span>
                                        </div>

                                        <input type="text"
                                               class="form-control"
                                               value="{{ $personal->direccion }}"
                                               disabled>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                                <div class="form-group">
                                    <label>Teléfono</label><b> (*)</b>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-phone"></i>
                                            </span>
                                        </div>

                                        <input type="text"
                                               class="form-control"
                                               value="{{ $personal->telefono }}"
                                               disabled>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                                <div class="form-group">
                                    <label>Profesión</label><b> (*)</b>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-briefcase"></i>
                                            </span>
                                        </div>

                                        <input type="text"
                                               class="form-control"
                                               value="{{ $personal->profesion }}"
                                               disabled>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label>Email</label><b> (*)</b>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-envelope"></i>
                                            </span>
                                        </div>

                                        <input type="email"
                                               class="form-control"
                                               value="{{ $personal->usuario->email }}"
                                               disabled>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <hr>

                        <h5><b>Requisitos académicos</b></h5>

                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-check">
                                    <input type="checkbox"
                                           class="form-check-input"
                                           disabled
                                           {{ $personal->es_profesional_area ? 'checked' : '' }}>
                                    <label class="form-check-label">
                                        Es profesional del área
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-check">
                                    <input type="checkbox"
                                           class="form-check-input"
                                           disabled
                                           {{ $personal->tiene_maestria ? 'checked' : '' }}>
                                    <label class="form-check-label">
                                        Tiene maestría
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-check">
                                    <input type="checkbox"
                                           class="form-check-input"
                                           disabled
                                           {{ $personal->tiene_diplomado_educ_superior ? 'checked' : '' }}>
                                    <label class="form-check-label">
                                        Diplomado en Educación Superior
                                    </label>
                                </div>
                            </div>

                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-12">

                                <a href="{{ route('admin.personal.index', $personal->tipo) }}"
                                   class="btn btn-default">
                                    <i class="fas fa-arrow-left"></i>
                                    Volver
                                </a>

                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>
</div>
@stop

@section('css')
@stop

@section('js')
@stop