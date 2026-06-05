@extends('adminlte::page')

@section('content_header')
    <h1><b>Listado de Personal {{ ucfirst($tipo) }}</b></h1>
    <hr>
@stop

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">

                <div class="card-header">
                    <h3 class="card-title">Personal Registrado</h3>

                    <div class="card-tools">
                        <a href="{{ route('admin.personal.create', $tipo) }}"
                            class="btn btn-primary">
                            Crear nuevo Personal
                        </a>
                    </div>
                </div>

                <div class="card-body">

                    <div class="table-responsive">

                        <table id="example1"
                            class="table table-bordered table-striped table-hover table-sm">

                            <thead>
                                <tr>
                                    <th>Nro</th>
                                    <th style="text-align: center">Rol</th>
                                    <th style="text-align: center">Apellidos y nombres</th>
                                    <th style="text-align: center">Carnet</th>
                                    <th style="text-align: center">Teléfono</th>
                                    <th style="text-align: center">Profesión</th>
                                    <th style="text-align: center">Profesional Área</th>
                                    <th style="text-align: center">Maestría</th>
                                    <th style="text-align: center">Diplomado E.S.</th>
                                    <th style="text-align: center">Correo</th>
                                    <th style="text-align: center">Acciones</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach ($personals as $personal)
                                    <tr>

                                        <td>{{ $loop->iteration }}</td>

                                        <td>
                                            {{ $personal->usuario->roles->pluck('name')->implode(', ') }}
                                        </td>

                                        <td>
                                            {{ $personal->apellidos }}
                                            {{ $personal->nombres }}
                                        </td>

                                        <td>{{ $personal->ci }}</td>

                                        <td>{{ $personal->telefono }}</td>

                                        <td>{{ $personal->profesion }}</td>

                                        <td class="text-center">
                                            @if ($personal->es_profesional_area)
                                                <span class="badge badge-success">Sí</span>
                                            @else
                                                <span class="badge badge-danger">No</span>
                                            @endif
                                        </td>

                                        <td class="text-center">
                                            @if ($personal->tiene_maestria)
                                                <span class="badge badge-success">Sí</span>
                                            @else
                                                <span class="badge badge-danger">No</span>
                                            @endif
                                        </td>

                                        <td class="text-center">
                                            @if ($personal->tiene_diplomado_educ_superior)
                                                <span class="badge badge-success">Sí</span>
                                            @else
                                                <span class="badge badge-danger">No</span>
                                            @endif
                                        </td>

                                        <td>
                                            {{ $personal->usuario->email }}
                                        </td>

                                        <td>

                                            <div class="d-flex flex-wrap gap-2 justify-content-center">

                                                <a href="{{ route('admin.personal.edit', $personal->id) }}"
                                                    class="btn btn-success btn-sm">
                                                    <i class="fas fa-pencil-alt"></i>
                                                    <span class="d-none d-sm-inline">
                                                        Editar
                                                    </span>
                                                </a>

                                                <a href="{{ route('admin.personal.show', $personal->id) }}"
                                                    class="btn btn-info btn-sm">
                                                    <i class="fas fa-eye"></i>
                                                    <span class="d-none d-sm-inline">
                                                        Ver
                                                    </span>
                                                </a>

                                                <form
                                                    action="{{ route('admin.personal.destroy', $personal->id) }}"
                                                    method="POST"
                                                    id="miFormulario{{ $personal->id }}"
                                                    class="m-0">

                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit"
                                                        class="btn btn-danger btn-sm"
                                                        onclick="preguntar{{ $personal->id }}(event)">
                                                        <i class="fas fa-trash-alt"></i>
                                                        <span class="d-none d-sm-inline">
                                                            Eliminar
                                                        </span>
                                                    </button>

                                                </form>

                                            </div>

                                            <script>
                                                function preguntar{{ $personal->id }}(event) {
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
                                                                'miFormulario{{ $personal->id }}'
                                                            ).submit();
                                                        }

                                                    });
                                                }
                                            </script>

                                        </td>

                                    </tr>
                                @endforeach

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>
        </div>
    </div>

@stop

@section('css')

    <style>
        #example1_wrapper .dt-buttons {
            background-color: transparent;
            box-shadow: none;
            border: none;
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-bottom: 15px;
        }

        #example1_wrapper .btn {
            color: #fff;
            border-radius: 4px;
            padding: 5px 15px;
            font-size: 14px;
        }

        .btn-danger {
            background-color: #dc3545;
            border: none;
        }

        .btn-success {
            background-color: #28a745;
            border: none;
        }

        .btn-info {
            background-color: #17a2b8;
            border: none;
        }

        .btn-warning {
            background-color: #ffc107;
            color: #212529;
            border: none;
        }

        .btn-default {
            background-color: #6e7176;
            color: #fff;
            border: none;
        }
    </style>

@stop

@section('js')

    <script>
        $(function() {

            $("#example1").DataTable({
                pageLength: 5,

                language: {
                    emptyTable: "No hay información",
                    info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
                    infoEmpty: "Mostrando 0 a 0 de 0 registros",
                    infoFiltered: "(Filtrado de _MAX_ registros)",
                    lengthMenu: "Mostrar _MENU_ registros",
                    loadingRecords: "Cargando...",
                    processing: "Procesando...",
                    search: "Buscador:",
                    zeroRecords: "Sin resultados encontrados",
                    paginate: {
                        first: "Primero",
                        last: "Último",
                        next: "Siguiente",
                        previous: "Anterior"
                    }
                },

                responsive: true,
                lengthChange: true,
                autoWidth: false,

                buttons: [{
                        text: '<i class="fas fa-copy"></i> COPIAR',
                        extend: 'copy',
                        className: 'btn btn-default'
                    },
                    {
                        text: '<i class="fas fa-file-pdf"></i> PDF',
                        extend: 'pdf',
                        className: 'btn btn-danger'
                    },
                    {
                        text: '<i class="fas fa-file-csv"></i> CSV',
                        extend: 'csv',
                        className: 'btn btn-info'
                    },
                    {
                        text: '<i class="fas fa-file-excel"></i> EXCEL',
                        extend: 'excel',
                        className: 'btn btn-success'
                    },
                    {
                        text: '<i class="fas fa-print"></i> IMPRIMIR',
                        extend: 'print',
                        className: 'btn btn-warning'
                    }
                ]
            }).buttons().container().appendTo(
                '#example1_wrapper .col-md-6:eq(0)'
            );

        });
    </script>

@stop
