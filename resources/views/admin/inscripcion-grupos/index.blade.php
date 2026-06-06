@extends('adminlte::page')

@section('content_header')
...
@stop

@section('content')

<div class="row">

    <div class="col-md-6">

        <div class="card card-outline card-primary">

            <div class="card-header">

                <h3 class="card-title">
                    Inscripciones Registradas
                </h3>
                <div class="card-tools">
                    <button type="button"
                        class="btn btn-primary"
                        data-toggle="modal"
                        data-target="#ModalCreate">
                        Nueva Inscripción
                    </button>
                    {{-- modal de creacion --}}
                    <div class="modal fade"
                        id="ModalCreate"
                        tabindex="-1">

                        <div class="modal-dialog">

                            <div class="modal-content">

                                <div class="modal-header"
                                    style="background-color:#007bff;color:white;">

                                    <h5 class="modal-title">
                                        Registrar Inscripción
                                    </h5>

                                    <button type="button"
                                        class="close"
                                        data-dismiss="modal">

                                        <span>&times;</span>

                                    </button>

                                </div>

                                <div class="modal-body">

                                    <form action="{{ route('admin.inscripcion-grupos.create') }}"
                                        method="POST">

                                        @csrf

                                        {{-- POSTULANTE --}}
                                        <div class="form-group">

                                            <label>Postulante</label><b> (*)</b>

                                            <select class="form-control"
                                                name="postulante_id"
                                                required>

                                                <option value="">
                                                    Seleccione un postulante
                                                </option>

                                                @foreach($postulantes as $postulante)

                                                <option value="{{ $postulante->id }}">

                                                    {{ $postulante->apellidos }}
                                                    {{ $postulante->nombres }}
                                                    -
                                                    {{ $postulante->ci }}

                                                </option>

                                                @endforeach

                                            </select>

                                        </div>

                                        {{-- GRUPO --}}
                                        <div class="form-group">

                                            <label>Grupo</label><b> (*)</b>

                                            <select class="form-control"
                                                name="grupo_id"
                                                required>

                                                <option value="">
                                                    Seleccione un grupo
                                                </option>

                                                @foreach($grupos as $grupo)

                                                <option value="{{ $grupo->id }}">

                                                    {{ $grupo->codigo }}
                                                    -
                                                    {{ $grupo->dias }}
                                                    -
                                                    {{ $grupo->modalidad }}

                                                </option>

                                                @endforeach

                                            </select>

                                        </div>

                                        {{-- FECHA --}}
                                        <div class="form-group">

                                            <label>Fecha de inscripción</label>

                                            <input type="date"
                                                class="form-control"
                                                name="fecha_eleccion"
                                                value="{{ date('Y-m-d') }}"
                                                required>

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
                <table id="example"
                    class="table table-bordered table-striped table-hover table-sm">
                    <thead>
                        <tr>
                            <th>Nro</th>
                            <th>Postulante</th>
                            <th>CI</th>
                            <th>Grupo</th>
                            <th>Fecha Inscripción</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($inscripcionGrupos as $inscripcionGrupo)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                {{ $inscripcionGrupo->postulante->apellidos }}
                                {{ $inscripcionGrupo->postulante->nombres }}
                            </td>
                            <td>
                                {{ $inscripcionGrupo->postulante->ci }}
                            </td>
                            <td>
                                {{ $inscripcionGrupo->grupo->codigo }}
                            </td>
                            <td>
                                {{ $inscripcionGrupo->fecha_eleccion }}
                            </td>
                            <td>

                                <button type="button"
                                    class="btn btn-success btn-sm"
                                    data-toggle="modal"
                                    data-target="#ModalUpdate{{ $inscripcionGrupo->id }}">
                                    <i class="fas fa-pencil-alt"></i>
                                    Editar
                                </button>

                                <form action="{{ route('admin.inscripcion-grupos.destroy',$inscripcionGrupo->id) }}"
                                    method="POST"
                                    id="miFormulario{{ $inscripcionGrupo->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="btn btn-danger btn-sm"
                                        onclick="return preguntar{{ $inscripcionGrupo->id }}(event)">

                                        <i class="fas fa-trash-alt"></i>
                                        Eliminar
                                    </button>
                                </form>

                                <script>
                                    function preguntar{{ $inscripcionGrupo->id }}(event) {
                                        event.preventDefault();

                                        Swal.fire({
                                            title: '¿Desea eliminar este registro?',
                                            icon: 'question',
                                            showDenyButton: true,
                                            confirmButtonText: 'Eliminar',
                                            denyButtonText: 'Cancelar',
                                        }).then((result) => {
                                            if (result.isConfirmed || result.value) {
                                                document.getElementById(
                                                    'miFormulario{{ $inscripcionGrupo->id }}'
                                                ).submit();
                                            }
                                        });
                                    }
                                </script>

                                <div class="modal fade"
                                    id="ModalUpdate{{ $inscripcionGrupo->id }}"
                                    tabindex="-1">

                                    <div class="modal-dialog">

                                        <div class="modal-content">

                                            <div class="modal-header"
                                                style="background-color:#28a745;color:white;">

                                                <h5 class="modal-title">

                                                    Editar Inscripción

                                                </h5>

                                                <button type="button"
                                                    class="close"
                                                    data-dismiss="modal">

                                                    <span>&times;</span>

                                                </button>

                                            </div>

                                            <div class="modal-body">

                                                <form action="{{ route('admin.inscripcion-grupos.update',$inscripcionGrupo->id) }}"
                                                    method="POST">

                                                    @csrf
                                                    @method('PUT')

                                                    {{-- POSTULANTE --}}
                                                    <div class="form-group">

                                                        <label>Postulante</label>

                                                        <select class="form-control"
                                                            name="postulante_id"
                                                            required>

                                                            @foreach($postulantes as $postulante)

                                                            <option value="{{ $postulante->id }}"
                                                                {{ $inscripcionGrupo->postulante_id == $postulante->id ? 'selected' : '' }}>

                                                                {{ $postulante->apellidos }}
                                                                {{ $postulante->nombres }}

                                                            </option>

                                                            @endforeach

                                                        </select>

                                                    </div>

                                                    {{-- GRUPO --}}
                                                    <div class="form-group">

                                                        <label>Grupo</label>

                                                        <select class="form-control"
                                                            name="grupo_id"
                                                            required>

                                                            @foreach($grupos as $grupo)

                                                            <option value="{{ $grupo->id }}"
                                                                {{ $inscripcionGrupo->grupo_id == $grupo->id ? 'selected' : '' }}>
                                                                {{ $grupo->codigo }}
                                                            </option>
                                                            @endforeach
                                                        </select>

                                                    </div>

                                                    {{-- FECHA --}}
                                                    <div class="form-group">
                                                        <label>Fecha</label>
                                                        <input type="date"
                                                            class="form-control"
                                                            name="fecha_eleccion"
                                                            value="{{ $inscripcionGrupo->fecha_eleccion }}"
                                                            required>

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
@stop

@section('js')

@if ($errors->any())

<script>
$(document).ready(function(){
    @if(session('modal_id'))

        $('#ModalUpdate{{ session('modal_id') }}').modal('show');
    @else
        $('#ModalCreate').modal('show');

    @endif
});
</script>
@endif

@stop