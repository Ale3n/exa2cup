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
                                        <form action="{{ url('/admin/gestiones/create') }}" method="POST">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="">Año de la gestión</label><b> (*)</b>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i
                                                                        class="fas fa-layer-group"></i></span>
                                                            </div>
                                                            <input type="text" class="form-control" name="año_create"
                                                                value="{{ old('año_create') }}"
                                                                placeholder="Escriba aquí..." required>
                                                        </div>
                                                        @error('año_create')
                                                            <small style="color: red;">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Periodo de la gestión</label><b> (*)</b>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i
                                                                        class="fas fa-layer-group"></i></span>
                                                            </div>
                                                            <input type="text" class="form-control" name="periodo_create"
                                                                value="{{ old('periodo_create') }}"
                                                                placeholder="Escriba aquí..." required>
                                                        </div>
                                                        @error('periodo_create')
                                                            <small style="color: red;">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Descripción de la gestión</label><b> (*)</b>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i
                                                                        class="fas fa-layer-group"></i></span>
                                                            </div>
                                                            <input type="text" class="form-control" name="descripcion_create"
                                                                value="{{ old('descripcion_create') }}"
                                                                placeholder="Escriba aquí..." required>
                                                        </div>
                                                        @error('descripcion_create')
                                                            <small style="color: red;">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                    <label for="">Estado de la gestion</label><b> (*)</b>
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
                                                            <option value="inactivo"
                                                                {{ old('estado_create') == 'inactivo' ? 'selected' : '' }}>
                                                                Inactivo
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
                                <th>ID real</th>
                                <th>año</th>
                                 <th>periodo</th>
                                 <th>descripcion</th>
                                <th>estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($gestiones as $gestion)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $gestion->id }}</td>
                                    <td>{{ $gestion->año }}</td>
                                    <td>{{ $gestion->periodo }}</td>
                                    <td>{{ $gestion->descripcion }}</td>
                                    <td>{{ $gestion->estado }}</td>
                                    <td>

                                        <div class="row d-flex justify-content-center">
                                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                                                data-target="#ModalUpdate{{ $gestion->id }}">
                                                <i class="fas fa-pencil-alt"></i> Editar
                                            </button>


                                            <form action="{{ url('/admin/gestiones/' . $gestion->id) }}" method="post"
                                                id="miFormulario{{ $gestion->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return preguntar{{ $gestion->id }}(event)">
                                                    <i class="fas fa-trash-alt"></i> Eliminar
                                                </button>
                                            </form>


                                        </div>


                                        <script>
                                            function preguntar{{ $gestion->id }}(event) {
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
                                                        'miFormulario{{ $gestion->id }}'
                                                    ).submit();
                                                }
                                            });
                                            return false;
                                        }
                                        </script>




                                        <!-- Modal de Edicion -->
                                        <div class="modal fade" id="ModalUpdate{{ $gestion->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header"
                                                        style="background-color: #09ae5b; color: white;">
                                                        <h5 class="modal-title" id="exampleModalLabel">Editar gestion</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ url('/admin/gestiones/' . $gestion->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <!-- año -->
                                                                <div class="form-group">

                                                                    <label>Año de la gestion</label><b> (*)</b>

                                                                    <div class="input-group mb-3">

                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text">
                                                                                <i class="fas fa-layer-group"></i>
                                                                            </span>
                                                                        </div>

                                                                        <input type="text"
                                                                            class="form-control"
                                                                            name="año"
                                                                            value="{{ old('año', $gestion->año) }}"
                                                                            placeholder="Escriba aquí..."
                                                                            required>

                                                                    </div>

                                                                    @error('año')
                                                                        <small style="color:red;">{{ $message }}</small>
                                                                    @enderror

                                                                </div>


                                                                <!-- periodo -->
                                                                <div class="form-group">

                                                                    <label>Período de la gestion</label><b> (*)</b>

                                                                    <div class="input-group mb-3">

                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text">
                                                                                <i class="fas fa-layer-group"></i>
                                                                            </span>
                                                                        </div>

                                                                        <input type="text"
                                                                            class="form-control"
                                                                            name="periodo"
                                                                            value="{{ old('periodo', $gestion->periodo) }}"
                                                                            placeholder="Escriba aquí..."
                                                                            required>

                                                                    </div>

                                                                    @error('periodo')
                                                                        <small style="color:red;">{{ $message }}</small>
                                                                    @enderror

                                                                </div>


                                                                <!-- Descripcion -->
                                                                <div class="form-group">

                                                                    <label>Descripción de la gestión</label><b> (*)</b>

                                                                    <div class="input-group mb-3">

                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text">
                                                                                <i class="fas fa-layer-group"></i>
                                                                            </span>
                                                                        </div>

                                                                        <input type="text"
                                                                            class="form-control"
                                                                            name="descripcion"
                                                                            value="{{ old('descripcion', $gestion->descripcion) }}"
                                                                            placeholder="Escriba aquí..."
                                                                            required>

                                                                    </div>

                                                                    @error('descripcion')
                                                                        <small style="color:red;">{{ $message }}</small>
                                                                    @enderror

                                                                </div>
                                                                <div class="form-group">

                                                                    <label>Estado de la gestión</label><b> (*)</b>

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
                                                                                {{ old('estado', $gestion->estado) == 'activo' ? 'selected' : '' }}>
                                                                                Activo
                                                                            </option>

                                                                            <option value="inactivo"
                                                                                {{ old('estado', $gestion->estado) == 'inactivo' ? 'selected' : '' }}>
                                                                                inactivo
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
