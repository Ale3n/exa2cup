@extends('adminlte::page')

@section('content_header')
    <h1>Creación de un nuevo Postulante</h1>
    <hr>
@stop

@section('content')

<div class="row">

    <div class="col-md-12">

        <div class="card card-primary">

            <div class="card-header">

                <h3 class="card-title">
                    Llene los datos del formulario
                </h3>

            </div>

            <div class="card-body">

                @if (session('mensaje'))
                    <div class="alert alert-{{ session('icono', 'info') }} alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {{ session('mensaje') }}
                    </div>
                @endif

                <form action="{{ route('admin.postulantes.store') }}"
                      method="POST">

                    @csrf

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
                                                    class="form-control"
                                                    readonly>

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
                                                   name="nombres"
                                                   class="form-control"
                                                   value="{{ old('nombres') }}"
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
                                                   name="apellidos"
                                                   class="form-control"
                                                   value="{{ old('apellidos') }}"
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

                                              <input type="number"
                                                  name="ci"
                                                  class="form-control"
                                                  value="{{ old('ci') }}"
                                                  placeholder="Ingrese CI..."
                                                  min="0"
                                                  step="1"
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
                                                   name="fecha_nacimiento"
                                                   class="form-control"
                                                   value="{{ old('fecha_nacimiento') }}"
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
                                                   name="direccion"
                                                   class="form-control"
                                                   value="{{ old('direccion') }}"
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

                                              <input type="number"
                                                  name="telefono"
                                                  class="form-control"
                                                  value="{{ old('telefono') }}"
                                                  placeholder="Ingrese teléfono..."
                                                  min="0"
                                                  step="1"
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
                                                    {{ old('genero') == 'masculino' ? 'selected' : '' }}>
                                                    Masculino
                                                </option>

                                                <option value="femenino"
                                                    {{ old('genero') == 'femenino' ? 'selected' : '' }}>
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
                                                   name="email"
                                                   class="form-control"
                                                   value="{{ old('email') }}"
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
                                                    {{ old('carrera_primera_id') == $carrera->id ? 'selected' : '' }}>

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
                                                    {{ old('carrera_segunda_id') == $carrera->id ? 'selected' : '' }}>

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

                            <hr>

                            {{-- DOCUMENTACION --}}
                            <h5>
                                <b>Documentación presentada</b>
                            </h5>

                            <div class="row">

                                <div class="col-md-4">

                                    <div class="form-check">

                                        <input type="hidden" name="tiene_bachiller" value="0">
                                        <input class="form-check-input"
                                               type="checkbox"
                                               name="tiene_bachiller"
                                               value="1"
                                               {{ old('tiene_bachiller') ? 'checked' : '' }}>

                                        <label class="form-check-label">
                                            Tiene Bachiller
                                        </label>

                                    </div>

                                </div>

                                <div class="col-md-4">

                                    <div class="form-check">

                                        <input type="hidden" name="entrego_libreta_notas" value="0">
                                        <input class="form-check-input"
                                               type="checkbox"
                                               name="entrego_libreta_notas"
                                               value="1"
                                               {{ old('entrego_libreta_notas') ? 'checked' : '' }}>

                                        <label class="form-check-label">
                                            Entregó Libreta de Notas
                                        </label>

                                    </div>

                                </div>

                                <div class="col-md-4">

                                    <div class="form-check">

                                        <input type="hidden" name="entrego_ci" value="0">
                                        <input class="form-check-input"
                                               type="checkbox"
                                               name="entrego_ci"
                                               value="1"
                                               {{ old('entrego_ci') ? 'checked' : '' }}>

                                        <label class="form-check-label">
                                            Entregó CI
                                        </label>

                                    </div>

                                </div>

                            </div>

                            <div class="row mt-2">

                                <div class="col-md-6">

                                    <div class="form-check">

                                        <input type="hidden" name="entrego_formulario_preinscripcion" value="0">
                                        <input class="form-check-input"
                                               type="checkbox"
                                               name="entrego_formulario_preinscripcion"
                                               value="1"
                                               {{ old('entrego_formulario_preinscripcion') ? 'checked' : '' }}>

                                        <label class="form-check-label">
                                            Entregó Formulario de Preinscripción
                                        </label>

                                    </div>

                                </div>

                                <div class="col-md-6">

                                    <div class="form-check">

                                        <input type="hidden" name="entrego_comprobante_pago" value="0">
                                        <input class="form-check-input"
                                               type="checkbox"
                                               name="entrego_comprobante_pago"
                                               value="1"
                                               {{ old('entrego_comprobante_pago') ? 'checked' : '' }}>
                                            Entregó Comprobante de Pago
                                        </label>

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
                                        class="btn btn-primary">

                                    <i class="fas fa-save"></i>
                                    Guardar

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