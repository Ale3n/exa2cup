@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')

    <p>Welcome to this beautiful admin panel.</p>

    @if(auth()->user()->hasAnyRole(['ADMINISTRADOR', 'ADMINISTRATIVO']))
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $totalInscritos ?? 0 }}</h3>
                        <p>Total inscritos</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $totalAprobados ?? 0 }}</h3>
                        <p>Total aprobados</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ $totalReprobados ?? 0 }}</h3>
                        <p>Total reprobados</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-times-circle"></i>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $totalGruposHabilitados ?? 0 }}</h3>
                        <p>Total grupos habilitados</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if(! empty($anuncio))

        <div class="modal fade" id="modalAnuncio" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header bg-primary">

                        <h5 class="modal-title">
                            {{ $anuncio->titulo }}
                        </h5>

                    </div>

                    <div class="modal-body">

                        {{ $anuncio->mensaje }}

                    </div>

                    <div class="modal-footer">

                        <button
                            type="button"
                            class="btn btn-primary"
                            id="btnCerrarAnuncio">

                            Entendido

                        </button>

                    </div>

                </div>
            </div>
        </div>

    @endif

@stop

@section('css')
    {{-- Tus estilos adicionales --}}
@stop

@section('js')

    <script>
        console.log("Hi, I'm using the Laravel-AdminLTE package!");
    </script>

    @if($anuncio)

        <script>

            $(document).ready(function () {

                $('#modalAnuncio').modal('show');

                $('#btnCerrarAnuncio').click(function () {

                    $.post(
                        '{{ route("anuncios.leido") }}',
                        {
                            anuncio_id: {{ $anuncio->id }},
                            _token: '{{ csrf_token() }}'
                        },
                        function () {

                            $('#modalAnuncio').modal('hide');

                        }
                    );

                });

            });

        </script>

    @endif

@stop