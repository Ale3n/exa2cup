@extends('adminlte::page')

@section('content_header')
    <h1>Datos del Postulante</h1>
    <hr>
@stop

@section('content')

<div class="row">

    <div class="col-md-12">

        <div class="card card-primary">

            <div class="card-header">

                <h3 class="card-title">
                    Datos del formulario
                </h3>

            </div>

            <div class="card-body">

                <div class="row">

                    <div class="col-md-12">

                        {{-- DATOS PERSONALES --}}
                        <div class="row">

                            {{-- ROL --}}
                            <div class="col-md-3">

                                <div class="form-group">

                                    <label>
                                        Nombre del rol
                                    </label>
                                    <b> (*)</b>

                                    <div class="input-group mb-3">

                                        <div class="input-group-prepend">

                                            <span class="input-group-text">
                                                <i class="fas fa-user-check"></i>
                                            </span>

                                        </div>

                                        <select class="form-control" disabled>

                                            <option>
                                                {{ $postulante->usuario->roles->pluck('name')->implode(', ') }}
                                            </option>

                                        </select>

                                    </div>

                                </div>

                            </div>

                            {{-- NOMBRES --}}
                            <div class="col-md-3">

                                <div class="form-group">

                                    <label>Nombres</label>
                                    <b> (*)</b>

                                    <div class="input-group mb-3">

                                        <div class="input-group-prepend">

                                            <span class="input-group-text">
                                                <i class="fas fa-user"></i>
                                            </span>

                                        </div>

                                        <input type="text"
                                               class="form-control"
                                               value="{{ $postulante->nombres }}"
                                               disabled>

                                    </div>

                                </div>

                            </div>

                            {{-- APELLIDOS --}}
                            <div class="col-md-3">

                                <div class="form-group">

                                    <label>Apellidos</label>
                                    <b> (*)</b>

                                    <div class="input-group mb-3">

                                        <div class="input-group-prepend">

                                            <span class="input-group-text">
                                                <i class="fas fa-user-friends"></i>
                                            </span>

                                        </div>

                                        <input type="text"
                                               class="form-control"
                                               value="{{ $postulante->apellidos }}"
                                               disabled>

                                    </div>

                                </div>

                            </div>

                            {{-- CI --}}
                            <div class="col-md-3">

                                <div class="form-group">

                                    <label>
                                        Cédula de Identidad
                                    </label>
                                    <b> (*)</b>

                                    <div class="input-group mb-3">

                                        <div class="input-group-prepend">

                                            <span class="input-group-text">
                                                <i class="fas fa-id-card"></i>
                                            </span>

                                        </div>

                                        <input type="text"
                                               class="form-control"
                                               value="{{ $postulante->ci }}"
                                               disabled>

                                    </div>

                                </div>

                            </div>

                        </div>

                        {{-- FECHA Y DIRECCION --}}
                        <div class="row">

                            <div class="col-md-3">

                                <div class="form-group">

                                    <label>
                                        Fecha Nacimiento
                                    </label>
                                    <b> (*)</b>

                                    <div class="input-group mb-3">

                                        <div class="input-group-prepend">

                                            <span class="input-group-text">
                                                <i class="fas fa-calendar-alt"></i>
                                            </span>

                                        </div>

                                        <input type="date"
                                               class="form-control"
                                               value="{{ $postulante->fecha_nacimiento }}"
                                               disabled>

                                    </div>

                                </div>

                            </div>

                            <div class="col-md-9">

                                <div class="form-group">

                                    <label>Dirección</label>
                                    <b> (*)</b>

                                    <div class="input-group mb-3">

                                        <div class="input-group-prepend">

                                            <span class="input-group-text">
                                                <i class="fas fa-map-marker-alt"></i>
                                            </span>

                                        </div>

                                        <input type="text"
                                               class="form-control"
                                               value="{{ $postulante->direccion }}"
                                               disabled>

                                    </div>

                                </div>

                            </div>

                        </div>

                        {{-- TELEFONO GENERO EMAIL --}}
                        <div class="row">

                            <div class="col-md-3">

                                <div class="form-group">

                                    <label>Teléfono</label>
                                    <b> (*)</b>

                                    <div class="input-group mb-3">

                                        <div class="input-group-prepend">

                                            <span class="input-group-text">
                                                <i class="fas fa-phone"></i>
                                            </span>

                                        </div>

                                        <input type="text"
                                               class="form-control"
                                               value="{{ $postulante->telefono }}"
                                               disabled>

                                    </div>

                                </div>

                            </div>

                            <div class="col-md-3">

                                <div class="form-group">

                                    <label>Genero</label>
                                    <b> (*)</b>

                                    <div class="input-group mb-3">

                                        <div class="input-group-prepend">

                                            <span class="input-group-text">
                                                <i class="fas fa-user-alt"></i>
                                            </span>

                                        </div>

                                        <select class="form-control" disabled>

                                            <option>
                                                {{ $postulante->genero }}
                                            </option>

                                        </select>

                                    </div>

                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>Email</label>
                                    <b> (*)</b>

                                    <div class="input-group mb-3">

                                        <div class="input-group-prepend">

                                            <span class="input-group-text">
                                                <i class="fas fa-envelope"></i>
                                            </span>

                                        </div>

                                        <input type="email"
                                               class="form-control"
                                               value="{{ $postulante->usuario->email }}"
                                               disabled>

                                    </div>

                                </div>

                            </div>

                        </div>

                        {{-- CARRERAS --}}
                        <div class="row">

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>
                                        Primera Carrera
                                    </label>

                                    <div class="input-group mb-3">

                                        <div class="input-group-prepend">

                                            <span class="input-group-text">
                                                <i class="fas fa-graduation-cap"></i>
                                            </span>

                                        </div>

                                        <input type="text"
                                               class="form-control"
                                               value="{{ $postulante->carreraPrimera->nombre ?? 'No definido' }}"
                                               disabled>

                                    </div>

                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>
                                        Segunda Carrera
                                    </label>

                                    <div class="input-group mb-3">

                                        <div class="input-group-prepend">

                                            <span class="input-group-text">
                                                <i class="fas fa-graduation-cap"></i>
                                            </span>

                                        </div>

                                        <input type="text"
                                               class="form-control"
                                               value="{{ $postulante->carreraSegunda->nombre ?? 'No definido' }}"
                                               disabled>

                                    </div>

                                </div>

                            </div>

                        </div>

                        {{-- ESTADO --}}
                        <div class="row">

                            <div class="col-md-4">

                                <div class="form-group">

                                    <label>
                                        Estado
                                    </label>

                                    <div class="input-group mb-3">

                                        <div class="input-group-prepend">

                                            <span class="input-group-text">
                                                <i class="fas fa-check-circle"></i>
                                            </span>

                                        </div>

                                        <input type="text"
                                               class="form-control"
                                               value="{{ strtoupper($postulante->estado) }}"
                                               disabled>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <hr>

                        {{-- DOCUMENTACION --}}
                        <h5>
                            <b>Documentación presentada</b>
                        </h5>

                        <div class="row">

                            <div class="col-md-4">

                                <div class="form-check">

                                    <input class="form-check-input"
                                           type="checkbox"
                                           disabled
                                           {{ $postulante->tiene_bachiller ? 'checked' : '' }}>

                                    <label class="form-check-label">
                                        Tiene Bachiller
                                    </label>

                                </div>

                            </div>

                            <div class="col-md-4">

                                <div class="form-check">

                                    <input class="form-check-input"
                                           type="checkbox"
                                           disabled
                                           {{ $postulante->entrego_libreta_notas ? 'checked' : '' }}>

                                    <label class="form-check-label">
                                        Entregó Libreta de Notas
                                    </label>

                                </div>

                            </div>

                            <div class="col-md-4">

                                <div class="form-check">

                                    <input class="form-check-input"
                                           type="checkbox"
                                           disabled
                                           {{ $postulante->entrego_ci ? 'checked' : '' }}>

                                    <label class="form-check-label">
                                        Entregó CI
                                    </label>

                                </div>

                            </div>

                        </div>

                        <div class="row mt-2">

                            <div class="col-md-6">

                                <div class="form-check">

                                    <input class="form-check-input"
                                           type="checkbox"
                                           disabled
                                           {{ $postulante->entrego_formulario_preinscripcion ? 'checked' : '' }}>

                                    <label class="form-check-label">
                                        Entregó Formulario de Preinscripción
                                    </label>

                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="form-check">

                                    <input class="form-check-input"
                                           type="checkbox"
                                           disabled
                                           {{ $postulante->entrego_comprobante_pago ? 'checked' : '' }}>

                                    <label class="form-check-label">
                                        Entregó Comprobante de Pago
                                    </label>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <hr>

                {{-- BOTON --}}
                <div class="row">

                    <div class="col-md-12">

                        <div class="form-group">

                            <a href="{{ url('/admin/postulantes/') }}"
                               class="btn btn-light">

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

@stop

@section('css')
@stop

@section('js')
@stop