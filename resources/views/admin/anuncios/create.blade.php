@extends('adminlte::page')

@section('title', 'Crear Anuncio')

@section('content_header')
    <h1>Crear Anuncio</h1>
@stop

@section('content')

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('anuncios.store') }}" method="POST">

        @csrf

        <div class="form-group">
            <label>Título</label>
            <input type="text"
                   name="titulo"
                   value="{{ old('titulo') }}"
                   class="form-control">
            @error('titulo') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label>Mensaje</label>

            <textarea name="mensaje"
                      class="form-control">{{ old('mensaje') }}</textarea>
            @error('mensaje') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label>Rol destino</label>

            <select name="rol_destino"
                    class="form-control">

                <option value="ESTUDIANTE" {{ old('rol_destino') == 'ESTUDIANTE' ? 'selected' : '' }}>
                    ESTUDIANTE
                </option>
                <option value="Postulante" {{ old('rol_destino') == 'Postulante' ? 'selected' : '' }}>
                    Postulante
                </option>

            </select>
        </div>

        <button class="btn btn-primary">
            Guardar
        </button>

    </form>

@stop