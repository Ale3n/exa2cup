@extends('adminlte::page')

@section('content_header')
    <h1>Editar Datos del Postulante</h1>
    <hr>
@stop

@section('content')

<div class="row">

    <div class="col-md-12">

        <div class="card card-success">

            <div class="card-header">

                <h3 class="card-title">
                    Modifique los datos del formulario
                </h3>

            </div>

            <div class="card-body">

                <form action="{{ route('admin.postulantes.update', $postulante->id) }}"
                      method="POST">

                    @csrf
                    @method('PUT')

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

                                            <select name="rol"
                                                    class="form-control">

                                                @foreach ($roles as $rol)

                                                    @if ($rol->name == 'ESTUDIANTE')

                                                        <option value="{{ $rol->name }}"
                                                                selected>

                                                            {{ $rol->name }}

                                                        </option>

                                                    @endif

                                                @endforeach

                                            </select>

                                        </div>

                                        @error('rol')

                                            <small style="color:red">
                                                {{ $message }}
                                            </small>

                                        @enderror

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
                                                   name="nombres"
                                                   value="{{ old('nombres', $postulante->nombres) }}"
                                                   placeholder="Ingrese nombres..."
                                                   required>

                                        </div>

                                        @error('nombres')

                                            <small style="color:red">
                                                {{ $message }}
                                            </small>

                                        @enderror

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
                                                   name="apellidos"
                                                   value="{{ old('apellidos', $postulante->apellidos) }}"
                                                   placeholder="Ingrese apellidos..."
                                                   required>

                                        </div>

                                        @error('apellidos')

                                            <small style="color:red">
                                                {{ $message }}
                                            </small>

                                        @enderror

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
                                                   name="ci"
                                                   value="{{ old('ci', $postulante->ci) }}"
                                                   placeholder="Ingrese CI..."
                                                   required>

                                        </div>

                                        @error('ci')

                                            <small style="color:red">
                                                {{ $message }}
                                            </small>

                                        @enderror

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
                                                   name="fecha_nacimiento"
                                                   value="{{ old('fecha_nacimiento', $postulante->fecha_nacimiento) }}"
                                                   required>

                                        </div>

                                        @error('fecha_nacimiento')

                                            <small style="color:red">
                                                {{ $message }}
                                            </small>

                                        @enderror

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
                                                   name="direccion"
                                                   value="{{ old('direccion', $postulante->direccion) }}"
                                                   placeholder="Ingrese dirección..."
                                                   required>

                                        </div>

                                        @error('direccion')

                                            <small style="color:red">
                                                {{ $message }}
                                            </small>

                                        @enderror

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
                                                   name="telefono"
                                                   value="{{ old('telefono', $postulante->telefono) }}"
                                                   placeholder="Ingrese teléfono..."
                                                   required>

                                        </div>

                                        @error('telefono')

                                            <small style="color:red">
                                                {{ $message }}
                                            </small>

                                        @enderror

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

                                            <select name="genero"
                                                    class="form-control">

                                                <option value="masculino"
                                                    {{ $postulante->genero == 'masculino' ? 'selected' : '' }}>

                                                    Masculino

                                                </option>

                                                <option value="femenino"
                                                    {{ $postulante->genero == 'femenino' ? 'selected' : '' }}>

                                                    Femenino

                                                </option>

                                            </select>

                                        </div>

                                        @error('genero')

                                            <small style="color:red">
                                                {{ $message }}
                                            </small>

                                        @enderror

                                    </div>

                                </div>

                                {{-- EMAIL --}}
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
                                                   name="email"
                                                   value="{{ old('email', $postulante->usuario->email) }}"
                                                   placeholder="Ingrese email..."
                                                   required>

                                        </div>

                                        @error('email')

                                            <small style="color:red">
                                                {{ $message }}
                                            </small>

                                        @enderror

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
                                        <b> (*)</b>

                                        <select name="carrera_primera_id"
                                                class="form-control"
                                                required>

                                            <option value="">
                                                Seleccione una carrera...
                                            </option>

                                            @foreach ($carreras as $carrera)

                                                <option value="{{ $carrera->id }}"
                                                    {{ $postulante->carrera_primera_id == $carrera->id ? 'selected' : '' }}>

                                                    {{ $carrera->nombre }}

                                                </option>

                                            @endforeach

                                        </select>

                                        @error('carrera_primera_id')

                                            <small style="color:red">
                                                {{ $message }}
                                            </small>

                                        @enderror

                                    </div>

                                </div>

                                <div class="col-md-6">

                                    <div class="form-group">

                                        <label>
                                            Segunda Carrera
                                        </label>

                                        <select name="carrera_segunda_id"
                                                class="form-control">

                                            <option value="">
                                                Seleccione una carrera...
                                            </option>

                                            @foreach ($carreras as $carrera)

                                                <option value="{{ $carrera->id }}"
                                                    {{ $postulante->carrera_segunda_id == $carrera->id ? 'selected' : '' }}>

                                                    {{ $carrera->nombre }}

                                                </option>

                                            @endforeach

                                        </select>

                                        @error('carrera_segunda_id')

                                            <small style="color:red">
                                                {{ $message }}
                                            </small>

                                        @enderror

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <hr>

                    {{-- BOTONES --}}
                    <div class="row">

                        <div class="col-md-12">

                            <div class="form-group">

                                <a href="{{ route('admin.postulantes.index') }}"
                                   class="btn btn-light">

                                    <i class="fas fa-arrow-left"></i>
                                    Cancelar

                                </a>

                                <button type="submit"
                                        class="btn btn-success">

                                    <i class="fas fa-save"></i>
                                    Actualizar

                                </button>

                            </div>

                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

@stop

@section('js')
@stop
