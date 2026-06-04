@extends('adminlte::page')

@section('content_header')
    <h1><b>Listado de Roles</b></h1>
    <hr>
@stop

@section('content')

    <div class="row">
        <div class="col-md-6">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Roles Registrados</h3>

                    <div class="card-tools">
                        <a href="{{ url('/admin/roles/create') }}" class="btn btn-primary">Crear nuevo Rol</a>
                    </div>
                </div>
                <div class="card-body">

                    <table id="example" class="table table-bordered table-striped table-hover table-sm">
                        <thead>
                            <tr>
                                <th>Nro</th>
                                <th>Nombre</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        <div class="row d-flex justify-content-center">
                                            <a href="{{ url('/admin/roles/' . $role->id . '/permisos') }}"
                                                class="btn btn-warning btn-sm">
                                                <i class="fas fa-check-circle"></i> Permisos
                                            </a>
                                            <a href="{{ url('/admin/roles/' . $role->id . '/edit') }}"
                                                class="btn btn-success btn-sm">
                                                <i class="fas fa-pencil-alt"></i> Editar
                                            </a>

                                            <form action="{{ route('admin.roles.destroy', $role->id) }}" method="post"
                                                id="miFormulario{{ $role->id }}" data-delete-form>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash-alt"></i> Eliminar
                                                </button>
                                            </form>
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
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('form[data-delete-form]').forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    event.preventDefault();

                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            title: '¿Desea eliminar este registro?',
                            icon: 'question',
                            showDenyButton: true,
                            confirmButtonText: 'Eliminar',
                            confirmButtonColor: '#a5161d',
                            denyButtonColor: '#270a0a',
                            denyButtonText: 'Cancelar',
                        }).then(function (result) {
                            if (result.isConfirmed || result.value) {
                                form.submit();
                            }
                        });
                        return;
                    }

                    if (window.confirm('¿Desea eliminar este registro?')) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@stop
