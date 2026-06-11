
@extends('adminlte::page')

@section('content_header')
    <h1>Creación de un nuevo Personal {{ ucfirst($tipo) }}</h1>
    <hr>
@stop

@section('content')

<div class="row">
    <div class="col-md-12">

        <div class="card card-primary">

            <div class="card-header">
                <h3 class="card-title">Llene los datos del formulario</h3>
            </div>

            <div class="card-body">

                <form action="{{ route('admin.personal.store') }}" method="POST">
                    @csrf

                    <input type="hidden" name="tipo" value="{{ $tipo }}">

                    <div class="row">

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Rol</label><b> (*)</b>

                                <select name="rol" class="form-control">
                                    <option value="">Seleccione un rol...</option>

                                    @foreach ($roles as $rol)
                                        <option value="{{ $rol->name }}"
                                            {{ old('rol') == $rol->name ? 'selected' : '' }}>
                                            {{ $rol->name }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('rol')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Nombres</label><b> (*)</b>

                                <input type="text"
                                    name="nombres"
                                    class="form-control"
                                    value="{{ old('nombres') }}"
                                    placeholder="Ingrese nombres..."
                                    required>

                                @error('nombres')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Apellidos</label><b> (*)</b>

                                <input type="text"
                                    name="apellidos"
                                    class="form-control"
                                    value="{{ old('apellidos') }}"
                                    placeholder="Ingrese apellidos..."
                                    required>

                                @error('apellidos')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Cédula de Identidad</label><b> (*)</b>

                                <input type="number"
                                    name="ci"
                                    class="form-control"
                                    value="{{ old('ci') }}"
                                    placeholder="Ingrese CI..."
                                    min="0"
                                    step="1"
                                    required>

                                @error('ci')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Fecha de nacimiento</label><b> (*)</b>

                                <input type="date"
                                    name="fecha_nacimiento"
                                    class="form-control"
                                    value="{{ old('fecha_nacimiento') }}"
                                    required>

                                @error('fecha_nacimiento')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-5">
                            <div class="form-group">
                                <label>Dirección</label><b> (*)</b>

                                <input type="text"
                                    name="direccion"
                                    class="form-control"
                                    value="{{ old('direccion') }}"
                                    placeholder="Ingrese dirección..."
                                    required>

                                @error('direccion')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Teléfono</label><b> (*)</b>

                                <input type="number"
                                    name="telefono"
                                    class="form-control"
                                    value="{{ old('telefono') }}"
                                    placeholder="Ingrese teléfono..."
                                    min="0"
                                    step="1"
                                    required>

                                @error('telefono')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Profesión</label><b> (*)</b>

                                <select name="profesion" class="form-control" required>
                                    <option value="">Seleccione una materia...</option>
                                    @foreach ($materias as $materia)
                                        <option value="{{ $materia->nombre }}"
                                            {{ old('profesion') == $materia->nombre ? 'selected' : '' }}>
                                            {{ $materia->nombre }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('profesion')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Email</label><b> (*)</b>

                                <input type="email"
                                    name="email"
                                    class="form-control"
                                    value="{{ old('email') }}"
                                    placeholder="Ingrese email..."
                                    required>

                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                    </div>

                    <hr>

                    <h5><b>Requisitos académicos</b></h5>

                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input"
                                    type="checkbox"
                                    name="es_profesional_area"
                                    id="es_profesional_area"
                                    value="1"
                                    {{ old('es_profesional_area') ? 'checked' : '' }}>

                                <label class="form-check-label"
                                    for="es_profesional_area">
                                    Es profesional del área
                                </label>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input"
                                    type="checkbox"
                                    name="tiene_maestria"
                                    id="tiene_maestria"
                                    value="1"
                                    {{ old('tiene_maestria') ? 'checked' : '' }}>

                                <label class="form-check-label"
                                    for="tiene_maestria">
                                    Tiene maestría
                                </label>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input"
                                    type="checkbox"
                                    name="tiene_diplomado_educ_superior"
                                    id="tiene_diplomado_educ_superior"
                                    value="1"
                                    {{ old('tiene_diplomado_educ_superior') ? 'checked' : '' }}>

                                <label class="form-check-label"
                                    for="tiene_diplomado_educ_superior">
                                    Diplomado en Educación Superior
                                </label>
                            </div>
                        </div>

                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-12">

                            <a href="{{ route('admin.personal.index', $tipo) }}"
                                class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i>
                                Cancelar
                            </a>

                            <button type="submit"
                                class="btn btn-primary">
                                <i class="fas fa-save"></i>
                                Guardar
                            </button>

                        </div>
                    </div>

                </form>

            </div>

        </div>

    </div>
</div>

@stop

@section('css')
@stop

@section('js')
@stop


