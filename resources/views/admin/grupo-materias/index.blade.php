
@extends('adminlte::page')

@section('content_header')
    <h1><b>Listado Grupo - Materia</b></h1>
    <hr>
@stop

@section('content')

<div class="row">
    <div class="col-md-12">

        <div class="card card-outline card-primary">

            <div class="card-header">

                <h3 class="card-title">
                    Asignaciones Registradas
                </h3>

                <div class="card-tools">

                    <button type="button"
                        class="btn btn-primary"
                        data-toggle="modal"
                        data-target="#ModalCreate">

                        Nueva Asignación

                    </button>

                </div>

            </div>

            <div class="card-body">

                <table id="example"
                    class="table table-bordered table-striped table-hover table-sm">

                    <thead>
                        <tr>
                            <th>Nro</th>
                            <th>Grupo</th>
                            <th>Materia</th>
                            <th>Docente</th>
                            <th>Aula</th>
                            <th>Hora Inicio</th>
                            <th>Hora Fin</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($grupoMaterias as $grupoMateria)

                            <tr>

                                <td>{{ $loop->iteration }}</td>

                                <td>
                                    {{ $grupoMateria->grupo->codigo ?? '' }}
                                </td>

                                <td>
                                    {{ $grupoMateria->materia->nombre ?? '' }}
                                </td>

                                <td>
                                    {{ $grupoMateria->personal->nombres ?? '' }}
                                </td>

                                <td>
                                    {{ $grupoMateria->aula->numero ?? '' }}
                                </td>

                                <td>
                                    {{ $grupoMateria->hora_inicio }}
                                </td>

                                <td>
                                    {{ $grupoMateria->hora_fin }}
                                </td>

                                <td>

                                    <div class="row d-flex justify-content-center">

                                        <button type="button"
                                            class="btn btn-success btn-sm mr-1"
                                            data-toggle="modal"
                                            data-target="#ModalUpdate{{ $grupoMateria->id }}">

                                            <i class="fas fa-pencil-alt"></i>
                                            Editar

                                        </button>

                                        <form action="{{ url('/admin/grupo-materias/' . $grupoMateria->id) }}"
                                            method="POST"
                                            id="miFormulario{{ $grupoMateria->id }}">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                class="btn btn-danger btn-sm"
                                                onclick="preguntar{{ $grupoMateria->id }}(event)">

                                                <i class="fas fa-trash-alt"></i>
                                                Eliminar

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                            <script>

                                function preguntar{{ $grupoMateria->id }}(event) {

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
                                                'miFormulario{{ $grupoMateria->id }}'
                                            ).submit();

                                        }

                                    });

                                }

                            </script>

                            {{-- MODAL UPDATE --}}
                            <div class="modal fade"
                                id="ModalUpdate{{ $grupoMateria->id }}"
                                tabindex="-1"
                                aria-hidden="true">

                                <div class="modal-dialog">

                                    <div class="modal-content">

                                        <div class="modal-header"
                                            style="background-color:#09ae5b;color:white;">

                                            <h5 class="modal-title">
                                                Editar Asignación
                                            </h5>

                                            <button type="button"
                                                class="close"
                                                data-dismiss="modal">

                                                <span>&times;</span>

                                            </button>

                                        </div>

                                        <div class="modal-body">

                                            <form action="{{ url('/admin/grupo-materias/' . $grupoMateria->id) }}"
                                                method="POST">

                                                @csrf
                                                @method('PUT')

                                                <div class="row">

                                                    <div class="col-md-6">
                                                        <div class="form-group">

                                                            <label>Grupo</label>

                                                            <select name="grupo_id"
                                                                class="form-control"
                                                                required>

                                                                @foreach ($grupos as $grupo)

                                                                    <option value="{{ $grupo->id }}"
                                                                        {{ $grupoMateria->grupo_id == $grupo->id ? 'selected' : '' }}>

                                                                        {{ $grupo->codigo }}

                                                                    </option>

                                                                @endforeach

                                                            </select>

                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">

                                                            <label>Materia</label>

                                                            <select name="materia_id"
                                                                class="form-control"
                                                                required>

                                                                @foreach ($materias as $materia)

                                                                    <option value="{{ $materia->id }}"
                                                                        {{ $grupoMateria->materia_id == $materia->id ? 'selected' : '' }}>

                                                                        {{ $materia->nombre }}

                                                                    </option>

                                                                @endforeach

                                                            </select>

                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="row">

                                                    <div class="col-md-6">
                                                        <div class="form-group">

                                                            <label>Docente</label>

                                                            <select name="personal_id"
                                                                class="form-control"
                                                                required>

                                                                @foreach ($personales as $personal)

                                                                    <option value="{{ $personal->id }}"
                                                                        {{ $grupoMateria->personal_id == $personal->id ? 'selected' : '' }}>

                                                                        {{ $personal->apellidos }} {{ $personal->nombres }}
                                                                        ({{ $personal->profesion }})

                                                                    </option>

                                                                @endforeach

                                                            </select>

                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">

                                                            <label>Aula</label>

                                                            <select name="aula_id"
                                                                class="form-control"
                                                                required>

                                                                @foreach ($aulas as $aula)

                                                                    <option value="{{ $aula->id }}"
                                                                        {{ $grupoMateria->aula_id == $aula->id ? 'selected' : '' }}>

                                                                        Aula {{ $aula->numero }}

                                                                    </option>

                                                                @endforeach

                                                            </select>

                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="row">

                                                    <div class="col-md-6">
                                                        <div class="form-group">

                                                            <label>Hora Inicio</label>

                                                            <input type="time"
                                                                class="form-control"
                                                                name="hora_inicio"
                                                                value="{{ $grupoMateria->hora_inicio }}"
                                                                required>

                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">

                                                            <label>Hora Fin</label>

                                                            <input type="time"
                                                                class="form-control"
                                                                name="hora_fin"
                                                                value="{{ $grupoMateria->hora_fin }}"
                                                                required>

                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="row">

                                                    <div class="col-md-12 text-right">

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
    aria-hidden="true">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header"
                style="background-color:#007bff;color:white;">

                <h5 class="modal-title">
                    Nueva Asignación
                </h5>

                <button type="button"
                    class="close"
                    data-dismiss="modal">

                    <span>&times;</span>

                </button>

            </div>

            <div class="modal-body">

                <form action="{{ url('/admin/grupo-materias/create') }}"
                    method="POST">

                    @csrf

                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">

                                <label>Grupo</label>

                                <select name="grupo_id"
                                    class="form-control"
                                    required>

                                    <option value="">Seleccione...</option>

                                    @foreach ($grupos as $grupo)

                                        <option value="{{ $grupo->id }}">

                                            {{ $grupo->codigo }}

                                        </option>

                                    @endforeach

                                </select>

                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">

                                <label>Materia</label>

                                <select name="materia_id"
                                    class="form-control"
                                    required>

                                    <option value="">Seleccione...</option>

                                    @foreach ($materias as $materia)

                                        <option value="{{ $materia->id }}">

                                            {{ $materia->nombre }}

                                        </option>

                                    @endforeach

                                </select>

                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">

                                <label>Docente</label>

                                <select name="personal_id"
                                    class="form-control"
                                    required>

                                    <option value="">Seleccione...</option>

                                    @foreach ($personales as $personal)

                                        <option value="{{ $personal->id }}">

                                            {{ $personal->apellidos }} {{ $personal->nombres }}
                                            ({{ $personal->profesion }})

                                        </option>

                                    @endforeach

                                </select>

                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">

                                <label>Aula</label>

                                <select name="aula_id"
                                    class="form-control"
                                    required>

                                    <option value="">Seleccione...</option>

                                    @foreach ($aulas as $aula)

                                        <option value="{{ $aula->id }}">

                                            Aula {{ $aula->numero }}

                                        </option>

                                    @endforeach

                                </select>

                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">

                                <label>Hora Inicio</label>

                                <input type="time"
                                    class="form-control"
                                    name="hora_inicio"
                                    required>

                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">

                                <label>Hora Fin</label>

                                <input type="time"
                                    class="form-control"
                                    name="hora_fin"
                                    required>

                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-12 text-right">

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
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        @if (session('mensaje'))
            Swal.fire({
                icon: "{{ session('icono', 'info') }}",
                title: "{{ session('mensaje') }}",
                showConfirmButton: true,
                timer: 3000
            });
        @endif
    </script>

    @if (session('modal_id'))
        <script>
            $(document).ready(function () {
                $('#modal-editar-{{ session('modal_id') }}').modal('show');
            });
        </script>
    @endif
@endsection
@stop
