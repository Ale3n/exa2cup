@extends('adminlte::page')

@section('content_header')
    <h1><b>Listado de Gestiones</b></h1>
    <hr>
@stop

@section('content')

    <div class="row">
        <div class="col-md-6">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Gestiones Registradas</h3>

                    <div class="card-tools">

                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalCreate">
                            Crear nueva gestión
                        </button>

                        <!-- Modal de Creacion -->
                        <!-- Modal de Creación -->
                            <div class="modal fade" id="ModalCreate" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">

                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <div class="modal-header" style="background-color: #007bff; color: white;">
                                            <h5 class="modal-title" id="exampleModalLabel">
                                                Registro de un nuevo grupo
                                            </h5>

                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <div class="modal-body">

                                            <form action="{{ route('admin.grupos.create') }}" method="POST">
                                                @csrf

                                                <!-- Gestión -->
                                                <div class="form-group">
                                                    <label>Gestión</label><b> (*)</b>

                                                    <div class="input-group mb-3">

                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="fas fa-calendar"></i>
                                                            </span>
                                                        </div>

                                                        <select class="form-control" name="gestion_id" required>

                                                            <option value="">Seleccione una gestión</option>

                                                            @foreach ($gestiones as $gestion)
                                                                <option value="{{ $gestion->id }}"
                                                                    {{ old('gestion_id') == $gestion->id ? 'selected' : '' }}>

                                                                    {{ $gestion->año }} - {{ $gestion->periodo }}

                                                                </option>
                                                            @endforeach

                                                        </select>

                                                    </div>

                                                    @error('gestion_id')
                                                        <small style="color:red;">{{ $message }}</small>
                                                    @enderror
                                                </div>


                                                <!-- Código -->
                                                <div class="form-group">

                                                    <label>Código del grupo</label><b> (*)</b>

                                                    <div class="input-group mb-3">

                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="fas fa-layer-group"></i>
                                                            </span>
                                                        </div>

                                                        <input type="text"
                                                            class="form-control"
                                                            name="codigo"
                                                            value="{{ old('codigo') }}"
                                                            placeholder="Escriba aquí..."
                                                            required>

                                                    </div>

                                                    @error('codigo')
                                                        <small style="color:red;">{{ $message }}</small>
                                                    @enderror

                                                </div>


                                                <!-- Días -->
                                                <div class="form-group">

                                                    <label>Días</label>

                                                    <div class="input-group mb-3">

                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="fas fa-calendar-day"></i>
                                                            </span>
                                                        </div>

                                                        <input type="text"
                                                            class="form-control"
                                                            name="dias"
                                                            value="{{ old('dias') }}"
                                                            placeholder="Ej: Lunes - Miércoles - Viernes">

                                                    </div>

                                                    @error('dias')
                                                        <small style="color:red;">{{ $message }}</small>
                                                    @enderror

                                                </div>


                                                <!-- Modalidad -->
                                                <div class="form-group">

                                                    <label>Modalidad</label><b> (*)</b>

                                                    <div class="input-group mb-3">

                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="fas fa-chalkboard"></i>
                                                            </span>
                                                        </div>

                                                        <select class="form-control" name="modalidad" required>

                                                            <option value="">Seleccione una opción</option>

                                                            <option value="presencial"
                                                                {{ old('modalidad') == 'presencial' ? 'selected' : '' }}>
                                                                Presencial
                                                            </option>

                                                            <option value="virtual"
                                                                {{ old('modalidad') == 'virtual' ? 'selected' : '' }}>
                                                                Virtual
                                                            </option>

                                                        </select>

                                                    </div>

                                                    @error('modalidad')
                                                        <small style="color:red;">{{ $message }}</small>
                                                    @enderror

                                                </div>


                                                <!-- Inscritos -->
                                                <div class="form-group">

                                                    <label>Inscritos</label>

                                                    <div class="input-group mb-3">

                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="fas fa-user-check"></i>
                                                            </span>
                                                        </div>

                                                        <input type="number"
                                                            class="form-control"
                                                            name="inscritos"
                                                            value="{{ old('inscritos', 0) }}"
                                                            placeholder="Cantidad de inscritos">

                                                    </div>

                                                    @error('inscritos')
                                                        <small style="color:red;">{{ $message }}</small>
                                                    @enderror

                                                </div>


                                                <hr>

                                                <div class="row">

                                                    <div class="col-md-12 d-flex justify-content-between">

                                                        <button type="button"
                                                                class="btn btn-secondary"
                                                                data-dismiss="modal">
                                                            Cancelar
                                                        </button>

                                                        <button type="submit"
                                                                class="btn btn-primary">
                                                            Guardar
                                                        </button>

                                                    </div>

                                                </div>

                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>

                    </div>
                </div>
                <div class="card-body">

                    <table id="example" class="table table-bordered table-striped table-hover table-sm">
                        <thead>
                            <tr>
                                <th>Nro</th>
                                <th>Gestión</th>
                                <th>Código</th>
                                <th>Días</th>
                                <th>Modalidad</th>
                                <th>Inscritos</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($grupos as $grupo)
                                <tr>
                                     <td>{{ $loop->iteration }}</td>
                                    <td>
                                        {{ $grupo->gestion->año ?? '' }}
                                        -
                                        {{ $grupo->gestion->periodo ?? '' }}
                                    </td>
                                    <td>{{ $grupo->codigo }}</td>
                                    <td>{{ $grupo->dias }}</td>
                                    <td>{{ $grupo->modalidad }}</td>
                                    <td>{{ $grupo->inscritos }}</td>
                                    <td>

                                        <div class="row d-flex justify-content-center">
                                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                                                data-target="#ModalUpdate{{ $grupo->id }}">
                                                <i class="fas fa-pencil-alt"></i> Editar
                                            </button>


                                            <form action="{{ url('/admin/grupos/' . $grupo->id) }}" method="post"
                                                id="miFormulario{{ $grupo->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return preguntar{{ $grupo->id }}(event)">
                                                    <i class="fas fa-trash-alt"></i> Eliminar
                                                </button>
                                            </form>


                                        </div>


                                        <script>
                                            function preguntar{{ $grupo->id }}(event) {
                                            event.preventDefault();
                                            Swal.fire({
                                                title: '¿Desea eliminar este registro?',
                                                text: '',
                                                icon: 'question',
                                                showDenyButton: true,
                                                confirmButtonText: 'Eliminar',
                                                confirmButtonColor: '#a5161d',
                                                denyButtonColor: '#270a0a',
                                                denyButtonText: 'Cancelar',
                                            }).then((result) => {
                                                if (result.value) {
                                                    document.getElementById(
                                                        'miFormulario{{ $grupo->id }}'
                                                    ).submit();
                                                }
                                            });
                                            return false;
                                        }
                                        </script>




                                        <!-- Modal de Edicion -->
                                        <div class="modal fade" id="ModalUpdate{{ $grupo->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">

                                        <div class="modal-dialog">
                                            <div class="modal-content">

                                                <div class="modal-header" style="background-color: #09ae5b; color: white;">

                                                    <h5 class="modal-title" id="exampleModalLabel">
                                                        Editar grupo
                                                    </h5>

                                                    <button type="button" class="close"
                                                        data-dismiss="modal"
                                                        aria-label="Close">

                                                        <span aria-hidden="true">&times;</span>

                                                    </button>

                                                </div>

                                                <div class="modal-body">

                                                    <form action="{{ route('admin.grupos.update', $grupo->id) }}"
                                                        method="POST">

                                                        @csrf
                                                        @method('PUT')

                                                        <!-- Gestión -->
                                                        <div class="form-group">

                                                            <label>Gestión</label><b> (*)</b>

                                                            <div class="input-group mb-3">

                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">
                                                                        <i class="fas fa-calendar"></i>
                                                                    </span>
                                                                </div>

                                                                <select class="form-control"
                                                                        name="gestion_id"
                                                                        required>

                                                                    @foreach ($gestiones as $gestion)

                                                                        <option value="{{ $gestion->id }}"
                                                                            {{ old('gestion_id', $grupo->gestion_id) == $gestion->id ? 'selected' : '' }}>

                                                                            {{ $gestion->año }} - {{ $gestion->periodo }}

                                                                        </option>

                                                                    @endforeach

                                                                </select>

                                                            </div>

                                                            @error('gestion_id')
                                                                <small style="color:red;">{{ $message }}</small>
                                                            @enderror

                                                        </div>


                                                        <!-- Código -->
                                                        <div class="form-group">

                                                            <label>Código del grupo</label><b> (*)</b>

                                                            <div class="input-group mb-3">

                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">
                                                                        <i class="fas fa-layer-group"></i>
                                                                    </span>
                                                                </div>

                                                                <input type="text"
                                                                    class="form-control"
                                                                    name="codigo"
                                                                    value="{{ old('codigo', $grupo->codigo) }}"
                                                                    placeholder="Escriba aquí..."
                                                                    required>

                                                            </div>

                                                            @error('codigo')
                                                                <small style="color:red;">{{ $message }}</small>
                                                            @enderror

                                                        </div>


                                                        <!-- Días -->
                                                        <div class="form-group">

                                                            <label>Días</label>

                                                            <div class="input-group mb-3">

                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">
                                                                        <i class="fas fa-calendar-day"></i>
                                                                    </span>
                                                                </div>

                                                                <input type="text"
                                                                    class="form-control"
                                                                    name="dias"
                                                                    value="{{ old('dias', $grupo->dias) }}"
                                                                    placeholder="Ej: Lunes - Miércoles - Viernes">

                                                            </div>

                                                            @error('dias')
                                                                <small style="color:red;">{{ $message }}</small>
                                                            @enderror

                                                        </div>


                                                        <!-- Modalidad -->
                                                        <div class="form-group">

                                                            <label>Modalidad</label><b> (*)</b>

                                                            <div class="input-group mb-3">

                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">
                                                                        <i class="fas fa-chalkboard"></i>
                                                                    </span>
                                                                </div>

                                                                <select class="form-control"
                                                                        name="modalidad"
                                                                        required>

                                                                    <option value="presencial"
                                                                        {{ old('modalidad', $grupo->modalidad) == 'presencial' ? 'selected' : '' }}>
                                                                        Presencial
                                                                    </option>

                                                                    <option value="virtual"
                                                                        {{ old('modalidad', $grupo->modalidad) == 'virtual' ? 'selected' : '' }}>
                                                                        Virtual
                                                                    </option>

                                                                </select>

                                                            </div>

                                                            @error('modalidad')
                                                                <small style="color:red;">{{ $message }}</small>
                                                            @enderror

                                                        </div>


                                                        <!-- Inscritos -->
                                                        <div class="form-group">

                                                            <label>Inscritos</label>

                                                            <div class="input-group mb-3">

                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">
                                                                        <i class="fas fa-user-check"></i>
                                                                    </span>
                                                                </div>

                                                                <input type="number"
                                                                    class="form-control"
                                                                    name="inscritos"
                                                                    value="{{ old('inscritos', $grupo->inscritos) }}"
                                                                    placeholder="Cantidad de inscritos">

                                                            </div>

                                                            @error('inscritos')
                                                                <small style="color:red;">{{ $message }}</small>
                                                            @enderror

                                                        </div>


                                                        <hr>

                                                        <div class="row">

                                                            <div class="col-md-12 d-flex justify-content-between">

                                                                <button type="button"
                                                                        class="btn btn-secondary"
                                                                        data-dismiss="modal">
                                                                    Cancelar
                                                                </button>

                                                                <button type="submit"
                                                                        class="btn btn-success">
                                                                    Actualizar
                                                                </button>

                                                            </div>

                                                        </div>

                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>


                </div>
            </div>

        </div>
    </div>

@stop



@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop
{{--  hola --}}
@section('js')
    @if ($errors->any())
        <script>
            $(document).ready(function() {
                @if (session('modal_id'))
                    $('#ModalUpdate{{ session('modal_id') }}').modal('show');
                @else
                    // Opcional: solo si manejas un modal de creación que deba mostrarse por defecto o bajo otra condición
                    $('#ModalCreate').modal('show');
                @endif
            });
        </script>
    @endif
@stop
