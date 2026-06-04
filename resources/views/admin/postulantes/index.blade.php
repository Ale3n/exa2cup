@extends('adminlte::page')

@section('content_header')
    <h1><b>Listado de Postulantes</b></h1>
    <hr>
@stop

@section('content')

    <div class="row">
        <div class="col-md-12">

            <div class="card card-outline card-primary">

                <div class="card-header">

                    <h3 class="card-title">
                        Postulantes Registrados
                    </h3>

                    <div class="card-tools">
                        <a href="{{ url('/admin/postulantes/create') }}"
                           class="btn btn-primary">
                            Crear nuevo Postulante
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
                                    <th>Postulante</th>
                                    <th>CI</th>
                                    <th>Fecha Nac.</th>
                                    <th>Teléfono</th>
                                    <th>Género</th>
                                    <th>Correo</th>
                                    <th>1ra Carrera</th>
                                    <th>2da Carrera</th>
                                    <th>Estado</th>
                                    <th>Documentación</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach ($postulantes as $postulante)

                                    <tr>

                                        <td>{{ $loop->iteration }}</td>

                                        <td>
                                            {{ $postulante->apellidos }}
                                            {{ $postulante->nombres }}
                                        </td>

                                        <td>{{ $postulante->ci }}</td>

                                        <td>
                                            {{ $postulante->fecha_nacimiento }}
                                        </td>

                                        <td>{{ $postulante->telefono }}</td>

                                        <td>{{ $postulante->genero }}</td>

                                        <td>
                                            {{ $postulante->usuario->email }}
                                        </td>

                                        <td>
                                            {{ $postulante->carreraPrimera->nombre ?? 'No definido' }}
                                        </td>

                                        <td>
                                            {{ $postulante->carreraSegunda->nombre ?? 'No definido' }}
                                        </td>

                                        <td>

                                            @if ($postulante->estado == 'aprobado')

                                                <span class="badge badge-success">
                                                    APROBADO
                                                </span>

                                            @elseif($postulante->estado == 'pendiente')

                                                <span class="badge badge-warning">
                                                    PENDIENTE
                                                </span>

                                            @else

                                                <span class="badge badge-danger">
                                                    RECHAZADO
                                                </span>

                                            @endif

                                        </td>

                                        <td>

                                            @php

                                                $documentacionCompleta =

                                                    $postulante->tiene_bachiller &&
                                                    $postulante->entrego_libreta_notas &&
                                                    $postulante->entrego_ci &&
                                                    $postulante->entrego_formulario_preinscripcion &&
                                                    $postulante->entrego_comprobante_pago;

                                            @endphp

                                            @if ($documentacionCompleta)

                                                <span class="badge badge-success">
                                                    COMPLETA
                                                </span>

                                            @else

                                                <span class="badge badge-danger">
                                                    INCOMPLETA
                                                </span>

                                            @endif

                                        </td>

                                        <td>

                                            <div class="d-flex flex-wrap gap-2 justify-content-center">

                                                <a href="{{ url('/admin/postulantes/' . $postulante->id . '/edit') }}"
                                                   class="btn btn-success btn-sm">

                                                    <i class="fas fa-pencil-alt"></i>

                                                    <span class="d-none d-sm-inline">
                                                        Editar
                                                    </span>

                                                </a>

                                                <a href="{{ url('/admin/postulantes/' . $postulante->id) }}"
                                                   class="btn btn-info btn-sm">

                                                    <i class="fas fa-eye"></i>

                                                    <span class="d-none d-sm-inline">
                                                        Ver
                                                    </span>

                                                </a>

                                                <form action="{{ url('/admin/postulantes/' . $postulante->id) }}"
                                                      method="post"
                                                      id="miFormulario{{ $postulante->id }}"
                                                      class="m-0">

                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit"
                                                            class="btn btn-danger btn-sm"
                                                            onclick="preguntar{{ $postulante->id }}(event)">

                                                        <i class="fas fa-trash-alt"></i>
                                                        Eliminar

                                                    </button>

                                                </form>

                                            </div>

                                            <script>

                                                function preguntar{{ $postulante->id }}(event)
                                                {
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

                                                        if (result.isConfirmed || result.value)
                                                        {
                                                            document.getElementById(
                                                                'miFormulario{{ $postulante->id }}'
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

        color: #212529;

        border: none;
    }

</style>

@stop


@section('js')

<script>

    $(function() {

        $("#example1").DataTable({

            "pageLength": 5,

            "language": {

                "emptyTable": "No hay información",

                "info":
                    "Mostrando _START_ a _END_ de _TOTAL_ Postulantes",

                "infoEmpty":
                    "Mostrando 0 a 0 de 0 Postulantes",

                "infoFiltered":
                    "(Filtrado de _MAX_ total Postulantes)",

                "lengthMenu":
                    "Mostrar _MENU_ Postulantes",

                "loadingRecords":
                    "Cargando...",

                "processing":
                    "Procesando...",

                "search":
                    "Buscador:",

                "zeroRecords":
                    "Sin resultados encontrados",

                "paginate": {

                    "first":
                        "Primero",

                    "last":
                        "Último",

                    "next":
                        "Siguiente",

                    "previous":
                        "Anterior"
                }
            },

            "responsive": true,

            "lengthChange": true,

            "autoWidth": false,

            buttons: [

                {
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