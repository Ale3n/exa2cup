@extends('adminlte::page')

@section('content_header')
    <h1><b>Listado de CarrerasGestiones</b></h1>
    <hr>
@stop

@section('content')

    <div class="row">
        <div class="col-md-6">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">CarrerasGestiones Registradas</h3>

                    <div class="card-tools">

                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalCreate">
                            Crear nueva CarreraGestion
                        </button>

                        <!-- Modal de Creación -->
                        <div class="modal fade" id="ModalCreate" tabindex="-1" aria-labelledby="ModalCreateLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header" style="background-color: #007bff; color: white;">
                                        <h5 class="modal-title" id="ModalCreateLabel">Crear Carrera Gestión</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{route('admin.carrera-gestiones.create') }}" method="POST">
                                            @csrf

                                            <!-- Carrera -->
                                            <div class="form-group">
                                                <label>Carrera</label><b> (*)</b>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-book"></i>
                                                        </span>
                                                    </div>
                                                    <select class="form-control" name="carrera_id" required>
                                                        <option value="">Seleccione una carrera</option>
                                                        @foreach ($carreras as $carrera)
                                                                <option value="{{ $carrera->id }}" {{ old('carrera_id') == $carrera->id ? 'selected' : '' }}>
                                                                    {{ $carrera->id }} - {{ $carrera->nombre }}
                                                                </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @error('carrera_id')
                                                    <small style="color:red;">{{ $message }}</small>
                                                @enderror
                                            </div>

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
                                                                <option value="{{ $gestion->id }}" {{ old('gestion_id') == $gestion->id ? 'selected' : '' }}>
                                                                    {{ $gestion->id }} - {{ $gestion->año }} - {{ $gestion->periodo }}
                                                                </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @error('gestion_id')
                                                    <small style="color:red;">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <!-- Cupo máximo -->
                                            <div class="form-group">
                                                <label>Cupo máximo</label><b> (*)</b>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-users"></i>
                                                        </span>
                                                    </div>
                                                    <input type="number" class="form-control" name="cupo_maximo" value="{{ old('cupo_maximo') }}" placeholder="Ingrese el cupo máximo" required>
                                                </div>
                                                @error('cupo_maximo')
                                                    <small style="color:red;">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <!-- Admitidos -->
                                            <div class="form-group">
                                                <label>Admitidos</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-user-check"></i>
                                                        </span>
                                                    </div>
                                                    <input type="number" class="form-control" name="admitidos" value="{{ old('admitidos', 0) }}" placeholder="Cantidad de admitidos">
                                                </div>
                                                @error('admitidos')
                                                    <small style="color:red;">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <hr>
                                            <div class="row">
                                                <div class="col-md-12 d-flex justify-content-between">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                    <button type="submit" class="btn btn-primary">Guardar</button>
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
                                <th>Carrera</th>
                                <th>Gestión</th>
                                <th>Cupo máximo</th>
                                <th>Admitidos</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($carreraGestiones as $carreraGestion)
                                <tr>
                                     <td>{{ $loop->iteration }}</td>
                                    <td>
                                        {{ $carreraGestion->carrera->nombre ?? '' }}
                                    </td>
                                    <td>
                                        {{ $carreraGestion->gestion->año ?? '' }}
                                        -
                                        {{ $carreraGestion->gestion->periodo ?? '' }}
                                    </td>
                                    <td>{{ $carreraGestion->cupo_maximo }}</td>
                                    <td>{{ $carreraGestion->admitidos }}</td>
                                    <td>

                                        <div class="row d-flex justify-content-center">
                                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                                                data-target="#ModalUpdate{{ $carreraGestion->id }}">
                                                <i class="fas fa-pencil-alt"></i> Editar
                                            </button>


                                            <form action="{{ url('/admin/carrera-gestiones/' . $carreraGestion->id) }}" method="post"
                                                id="miFormulario{{ $carreraGestion->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return preguntar{{ $carreraGestion->id }}(event)">
                                                    <i class="fas fa-trash-alt"></i> Eliminar
                                                </button>
                                            </form>


                                        </div>


                                        <script>
                                            function preguntar{{ $carreraGestion->id }}(event) {
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
                                                        'miFormulario{{ $carreraGestion->id }}'
                                                    ).submit();
                                                }
                                            });
                                            return false;
                                        }
                                        </script>




                                        <!-- Modal de Edicion -->
                                        <div class="modal fade"
                                            id="ModalUpdate{{ $carreraGestion->id }}"
                                            tabindex="-1"
                                            aria-labelledby="exampleModalLabel"
                                            aria-hidden="true">

                                            <div class="modal-dialog">

                                                <div class="modal-content">

                                                    <div class="modal-header"
                                                        style="background-color: #09ae5b; color: white;">

                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                            Editar Carrera Gestión
                                                        </h5>

                                                        <button type="button"
                                                                class="close"
                                                                data-dismiss="modal"
                                                                aria-label="Close">

                                                            <span aria-hidden="true">&times;</span>

                                                        </button>

                                                    </div>

                                                    <div class="modal-body">

                                                        <form action="{{ route('admin.carrera-gestiones.update', $carreraGestion->id) }}"
                                                            method="POST">

                                                            @csrf
                                                            @method('PUT')

                                                            <!-- Carrera -->
                                                            <div class="form-group">

                                                                <label>Carrera</label><b> (*)</b>

                                                                <div class="input-group mb-3">

                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">
                                                                            <i class="fas fa-book"></i>
                                                                        </span>
                                                                    </div>

                                                                    <select class="form-control"
                                                                            name="carrera_id"
                                                                            required>

                                                                        @foreach ($carreras as $carrera)

                                                                            <option value="{{ $carrera->id }}" {{ old('carrera_id', $carreraGestion->carrera_id) == $carrera->id ? 'selected' : '' }}>
                                                                                {{ $carrera->id }} - {{ $carrera->nombre }}
                                                                            </option>

                                                                        @endforeach

                                                                    </select>

                                                                </div>

                                                                @error('carrera_id')
                                                                    <small style="color:red;">
                                                                        {{ $message }}
                                                                    </small>
                                                                @enderror

                                                            </div>


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

                                                                            <option value="{{ $gestion->id }}" {{ old('gestion_id', $carreraGestion->gestion_id) == $gestion->id ? 'selected' : '' }}>
                                                                                {{ $gestion->id }} - {{ $gestion->año }} - {{ $gestion->periodo }}
                                                                            </option>

                                                                        @endforeach

                                                                    </select>

                                                                </div>

                                                                @error('gestion_id')
                                                                    <small style="color:red;">
                                                                        {{ $message }}
                                                                    </small>
                                                                @enderror

                                                            </div>


                                                            <!-- Cupo máximo -->
                                                            <div class="form-group">

                                                                <label>Cupo máximo</label><b> (*)</b>

                                                                <div class="input-group mb-3">

                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">
                                                                            <i class="fas fa-users"></i>
                                                                        </span>
                                                                    </div>

                                                                    <input type="number"
                                                                        class="form-control"
                                                                        name="cupo_maximo"
                                                                        value="{{ old('cupo_maximo', $carreraGestion->cupo_maximo) }}"
                                                                        placeholder="Ingrese el cupo máximo"
                                                                        required>

                                                                </div>

                                                                @error('cupo_maximo')
                                                                    <small style="color:red;">
                                                                        {{ $message }}
                                                                    </small>
                                                                @enderror

                                                            </div>


                                                            <!-- Admitidos -->
                                                            <div class="form-group">

                                                                <label>Admitidos</label>

                                                                <div class="input-group mb-3">

                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">
                                                                            <i class="fas fa-user-check"></i>
                                                                        </span>
                                                                    </div>

                                                                    <input type="number"
                                                                        class="form-control"
                                                                        name="admitidos"
                                                                        value="{{ old('admitidos', $carreraGestion->admitidos) }}"
                                                                        placeholder="Cantidad de admitidos">

                                                                </div>

                                                                @error('admitidos')
                                                                    <small style="color:red;">
                                                                        {{ $message }}
                                                                    </small>
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