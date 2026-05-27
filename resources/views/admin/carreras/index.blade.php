@extends('adminlte::page')

@section('content_header')
    <h1><b>Listado de Carreras</b></h1>
    <hr>
@stop

@section('content')

    <div class="row">
        <div class="col-md-6">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Carreras Registradas</h3>

                    <div class="card-tools">

                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalCreate">
                            Crear nueva carrera
                        </button>

                        <!-- Modal de Creacion -->
                        <div class="modal fade" id="ModalCreate" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header" style="background-color: #007bff; color: white;">
                                        <h5 class="modal-title" id="exampleModalLabel">Registro de un nuevo nivel</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ url('/admin/carreras/create') }}" method="POST">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="">Nombre de la carrera</label><b> (*)</b>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i
                                                                        class="fas fa-layer-group"></i></span>
                                                            </div>
                                                            <input type="text" class="form-control" name="nombre_create"
                                                                value="{{ old('nombre_create') }}"
                                                                placeholder="Escriba aquí..." required>
                                                        </div>
                                                        @error('nombre_create')
                                                            <small style="color: red;">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Código de la carrera</label><b> (*)</b>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i
                                                                        class="fas fa-layer-group"></i></span>
                                                            </div>
                                                            <input type="text" class="form-control" name="codigo_create"
                                                                value="{{ old('codigo_create') }}"
                                                                placeholder="Escriba aquí..." required>
                                                        </div>
                                                        @error('codigo_create')
                                                            <small style="color: red;">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                    <label for="">Estado de la carrera</label><b> (*)</b>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="fas fa-layer-group"></i>
                                                            </span>
                                                        </div>
                                                        <select class="form-control" name="estado_create" required>
                                                            <option value="">Seleccione una opción</option>
                                                            <option value="activo"
                                                                {{ old('estado_create') == 'activo' ? 'selected' : '' }}>
                                                                Activo
                                                            </option>
                                                            <option value="cerrado"
                                                                {{ old('estado_create') == 'cerrado' ? 'selected' : '' }}>
                                                                Cerrado
                                                            </option>
                                                        </select>
                                                    </div>
                                                        @error('estado_create')
                                                            <small style="color: red;">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <hr>
                                                <div class="row">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Cancelar</button>
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
                                <th>Nombre</th>
                                 <th>Código</th>
                                 <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($carreras as $carrera)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $carrera->nombre }}</td>
                                    <td>{{ $carrera->codigo }}</td>
                                    <td>{{ $carrera->estado }}</td>
                                    <td>

                                        <div class="row d-flex justify-content-center">
                                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                                                data-target="#ModalUpdate{{ $carrera->id }}">
                                                <i class="fas fa-pencil-alt"></i> Editar
                                            </button>


                                            <form action="{{ url('/admin/carreras/' . $carrera->id) }}" method="post"
                                                id="miFormulario{{ $carrera->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return preguntar{{ $carrera->id }}(event)">
                                                    <i class="fas fa-trash-alt"></i> Eliminar
                                                </button>
                                            </form>


                                        </div>


                                        <script>
                                            function preguntar{{ $carrera->id }}(event) {
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
                                                        'miFormulario{{ $carrera->id }}'
                                                    ).submit();
                                                }
                                            });
                                            return false;
                                        }
                                        </script>




                                        <!-- Modal de Edicion -->
                                        <div class="modal fade" id="ModalUpdate{{ $carrera->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header"
                                                        style="background-color: #09ae5b; color: white;">
                                                        <h5 class="modal-title" id="exampleModalLabel">Editar carrera</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ url('/admin/carreras/' . $carrera->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <!-- Nombre -->
                                                                <div class="form-group">

                                                                    <label>Nombre de la carrera</label><b> (*)</b>

                                                                    <div class="input-group mb-3">

                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text">
                                                                                <i class="fas fa-layer-group"></i>
                                                                            </span>
                                                                        </div>

                                                                        <input type="text"
                                                                            class="form-control"
                                                                            name="nombre"
                                                                            value="{{ old('nombre', $carrera->nombre) }}"
                                                                            placeholder="Escriba aquí..."
                                                                            required>

                                                                    </div>

                                                                    @error('nombre')
                                                                        <small style="color:red;">{{ $message }}</small>
                                                                    @enderror

                                                                </div>


                                                                <!-- Código -->
                                                                <div class="form-group">

                                                                    <label>Código de la carrera</label><b> (*)</b>

                                                                    <div class="input-group mb-3">

                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text">
                                                                                <i class="fas fa-layer-group"></i>
                                                                            </span>
                                                                        </div>

                                                                        <input type="text"
                                                                            class="form-control"
                                                                            name="codigo"
                                                                            value="{{ old('codigo', $carrera->codigo) }}"
                                                                            placeholder="Escriba aquí..."
                                                                            required>

                                                                    </div>

                                                                    @error('codigo')
                                                                        <small style="color:red;">{{ $message }}</small>
                                                                    @enderror

                                                                </div>


                                                                <!-- Estado -->
                                                                <div class="form-group">

                                                                    <label>Estado de la carrera</label><b> (*)</b>

                                                                    <div class="input-group mb-3">

                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text">
                                                                                <i class="fas fa-layer-group"></i>
                                                                            </span>
                                                                        </div>

                                                                        <select class="form-control"
                                                                                name="estado"
                                                                                required>

                                                                            <option value="activo"
                                                                                {{ old('estado', $carrera->estado) == 'activo' ? 'selected' : '' }}>
                                                                                Activo
                                                                            </option>

                                                                            <option value="cerrado"
                                                                                {{ old('estado', $carrera->estado) == 'cerrado' ? 'selected' : '' }}>
                                                                                Cerrado
                                                                            </option>

                                                                        </select>

                                                                    </div>

                                                                    @error('estado')
                                                                        <small style="color:red;">{{ $message }}</small>
                                                                    @enderror

                                                                </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <hr>
                                                                <div class="row">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Cancelar</button>
                                                                    <button type="submit"
                                                                        class="btn btn-success">Actualizar</button>
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
