
@extends('adminlte::page')

@section('content_header')
    <h1>Editar Personal {{ ucfirst($personal->tipo) }}</h1>
    <hr>
@stop

@section('content')

<div class="row">
    <div class="col-md-12">

        <div class="card card-success">

            <div class="card-header">
                <h3 class="card-title">Actualizar datos del personal</h3>
            </div>

            <div class="card-body">

                <form action="{{ route('admin.personal.update', $personal->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="tipo" value="{{ $personal->tipo }}">

                    <div class="row">

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Rol</label><b> (*)</b>

                                <select name="rol" class="form-control">
                                    <option value="">Seleccione un rol...</option>

                                    @foreach ($roles as $rol)
                                        <option value="{{ $rol->name }}"
                                            {{ $rol->name == $personal->usuario->roles->pluck('name')->first() ? 'selected' : '' }}>
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
                                       value="{{ old('nombres', $personal->nombres) }}"
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
                                       value="{{ old('apellidos', $personal->apellidos) }}"
                                       required>

                                @error('apellidos')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Cédula de Identidad</label><b> (*)</b>

                                <input type="text"
                                       name="ci"
                                       class="form-control"
                                       value="{{ old('ci', $personal->ci) }}"
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
                                       value="{{ old('fecha_nacimiento', $personal->fecha_nacimiento) }}"
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
                                       value="{{ old('direccion', $personal->direccion) }}"
                                       required>

                                @error('direccion')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Teléfono</label><b> (*)</b>

                                <input type="text"
                                       name="telefono"
                                       class="form-control"
                                       value="{{ old('telefono', $personal->telefono) }}"
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

                                <input type="text"
                                       name="profesion"
                                       class="form-control"
                                       value="{{ old('profesion', $personal->profesion) }}"
                                       required>

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
                                       value="{{ old('email', $personal->usuario->email) }}"
                                       required>

                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                    </div>

                    <hr>

                    <a href="{{ route('admin.personal.index', $personal->tipo) }}"
                       class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i>
                        Cancelar
                    </a>

                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i>
                        Actualizar
                    </button>

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

