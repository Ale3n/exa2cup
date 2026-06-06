@extends('adminlte::page')

@section('content_header')
<h1><b>Listado de Calificaciones</b></h1>
<hr>
@stop

@section('content')

<div class="row">
    <div class="col-md-8">

        <div class="card card-outline card-primary">

            <div class="card-header">
                <h3 class="card-title">Calificaciones Registradas</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-primary" data-toggle="modal"
                        data-target="#ModalCreate">
                        Crear nueva calificación
                    </button>
                </div>
            </div>

            <div class="card-body">

                <table id="example"
                    class="table table-bordered table-striped table-hover table-sm">
                    <thead>
                        <tr>
                            <th>Nro</th>
                            <th>Inscripción</th>
                            <th>Materia</th>
                            <th>Examen</th>
                            <th>Nota</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach($calificaciones as $calificacion)

                        <tr>

                            <td>{{ $loop->iteration }}</td>

                            <td>
                                {{ optional($calificacion->inscripcionGrupo->postulante)->nombres }}
                                {{ optional($calificacion->inscripcionGrupo->postulante)->apellidos }}
                                - Grupo {{ optional($calificacion->inscripcionGrupo->grupo)->codigo }}
                            </td>

                            <td>
                                {{ $calificacion->materia->nombre }}
                            </td>

                            <td>
                                {{ $calificacion->numero_examen }}
                            </td>

                            <td>
                                {{ $calificacion->nota }}
                            </td>

                            <td>

                                <div class="row d-flex justify-content-center">

                                    <button type="button"
                                        class="btn btn-success btn-sm mr-1"
                                        data-toggle="modal"
                                        data-target="#ModalUpdate{{ $calificacion->id }}">
                                        <i class="fas fa-pencil-alt"></i> Editar
                                    </button>

                                    <form action="{{ url('/admin/calificaciones/'.$calificacion->id) }}"
                                        method="POST"
                                        id="miFormulario{{ $calificacion->id }}">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            class="btn btn-danger btn-sm"
                                            onclick="preguntar{{ $calificacion->id }}(event)">
                                            <i class="fas fa-trash-alt"></i> Eliminar
                                        </button>

                                    </form>

                                    <script>
                                        function preguntar{{ $calificacion->id }}(event) {
                                            event.preventDefault();

                                            Swal.fire({
                                                title: '¿Desea eliminar este registro?',
                                                icon: 'question',
                                                showDenyButton: true,
                                                confirmButtonText: 'Eliminar',
                                                confirmButtonColor: '#a5161d',
                                                denyButtonColor: '#270a0a',
                                                denyButtonText: 'Cancelar',
                                            }).then((result) => {

                                                if (result.isConfirmed || result.value) {
                                                    document.getElementById(
                                                        'miFormulario{{ $calificacion->id }}'
                                                    ).submit();
                                                }

                                            });
                                        }
                                    </script>

                                </div>

                            </td>

                        </tr>
                        <div class="modal fade"
                            id="ModalUpdate{{ $calificacion->id }}"
                            tabindex="-1">

                            <div class="modal-dialog">

                                <div class="modal-content">

                                    <div class="modal-header bg-success">

                                        <h5 class="modal-title">
                                            Editar Calificación
                                        </h5>

                                        <button type="button"
                                            class="close"
                                            data-dismiss="modal">

                                            <span>&times;</span>

                                        </button>

                                    </div>

                                    <div class="modal-body">

                                        <form action="{{ url('/admin/calificaciones/'.$calificacion->id) }}"
                                            method="POST">

                                            @csrf
                                            @method('PUT')

                                            <div class="form-group">

                                                <label>Inscripción</label>

                                                <select name="inscripcion_grupo_id"
                                                    class="form-control">

                                                    @foreach($inscripciones as $inscripcion)

                                                    <option
                                                        value="{{ $inscripcion->id }}"
                                                        {{ $calificacion->inscripcion_grupo_id == $inscripcion->id ? 'selected' : '' }}>
                                                        {{ optional($inscripcion->postulante)->nombres }}
                                                        {{ optional($inscripcion->postulante)->apellidos }}
                                                        - Grupo {{ optional($inscripcion->grupo)->codigo }}
                                                    </option>

                                                    @endforeach

                                                </select>

                                            </div>

                                            <div class="form-group">

                                                <label>Materia</label>

                                                <select name="materia_id"
                                                    class="form-control">

                                                    @foreach($materias as $materia)

                                                    <option
                                                        value="{{ $materia->id }}"
                                                        {{ $calificacion->materia_id == $materia->id ? 'selected' : '' }}>
                                                        {{ $materia->nombre }}
                                                    </option>

                                                    @endforeach

                                                </select>

                                            </div>

                                            <div class="form-group">

                                                <label>Examen</label>

                                                <select name="numero_examen"
                                                    class="form-control">
                                                    <option value="1" {{ $calificacion->numero_examen == 1 ? 'selected' : '' }}>1</option>
                                                    <option value="2" {{ $calificacion->numero_examen == 2 ? 'selected' : '' }}>2</option>
                                                    <option value="3" {{ $calificacion->numero_examen == 3 ? 'selected' : '' }}>3</option>
                                                </select>

                                            </div>

                                            <div class="form-group">

                                                <label>Nota</label>

                                                <input type="number"
                                                    step="0.01"
                                                    min="0"
                                                    max="100"
                                                    name="nota"
                                                    class="form-control"
                                                    value="{{ $calificacion->nota }}">

                                            </div>

                                            <div class="text-right">

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

                                        </form>

                                    </div>

                                </div>

                            </div>

                        </div>

                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>

    </div>
</div>

{{-- MODAL CREATE --}}
<div class="modal fade"
    id="ModalCreate"
    tabindex="-1"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header"
                style="background-color: #007bff; color: white;">

                <h5 class="modal-title">
                    Registro de una nueva aula
                </h5>

                <button type="button"
                    class="close"
                    data-dismiss="modal"
                    aria-label="Close">

                    <span aria-hidden="true">&times;</span>

                </button>

            </div>

            <div class="modal-body">

                <form action="{{ url('/admin/calificaciones/create') }}"
                    method="POST">

                    @csrf

                    <div class="form-group">

                        <label>Inscripción</label><b> (*)</b>

                        <select name="inscripcion_grupo_id_create"
                            class="form-control"
                            required>

                            <option value="">Seleccione...</option>

                            @foreach($inscripciones as $inscripcion)
                            <option value="{{ $inscripcion->id }}">
                                {{ optional($inscripcion->postulante)->nombres }}
                                {{ optional($inscripcion->postulante)->apellidos }}
                                - Grupo {{ optional($inscripcion->grupo)->codigo }}
                            </option>
                            @endforeach

                        </select>

                    </div>

                    <div class="form-group">

                        <label>Materia</label><b> (*)</b>

                        <select name="materia_id_create"
                            class="form-control"
                            required>

                            <option value="">Seleccione...</option>

                            @foreach($materias as $materia)
                            <option value="{{ $materia->id }}">
                                {{ $materia->nombre }}
                            </option>
                            @endforeach

                        </select>

                    </div>

                    <div class="form-group">

                        <label>Número de Examen</label><b> (*)</b>

                        <select name="numero_examen_create"
                            class="form-control"
                            required>
                            <option value="">Seleccione...</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>

                    </div>

                    <div class="form-group">

                        <label>Nota</label><b> (*)</b>

                        <input type="number"
                            step="0.01"
                            min="0"
                            max="100"
                            class="form-control"
                            name="nota_create"
                            required>

                    </div>

                    <div class="text-right">

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

                </form>

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
    $(document).ready(function() {

        @if(session('modal_id'))
        $('#ModalUpdate{{ session('
            modal_id ') }}').modal('show');
        @else
        $('#ModalCreate').modal('show');
        @endif

    });
</script>

@endif

@stop