@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Sala</h1>

    <form action="{{ route('salas.updateSala', $sala->id) }}" method="POST">
        @csrf
        @method('PATCH')

        <div class="form-group mb-3">
            <label for="nombre">Nombre de la Sala</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre', $sala->nombre) }}" required>
            @error('nombre')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="descripcion">Descripción</label>
            <textarea name="descripcion" id="descripcion" class="form-control">{{ old('descripcion', $sala->descripcion) }}</textarea>
            @error('descripcion')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Actualizar Sala</button>
        <a href="{{ route('salas.manage') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
{!! \App\Helpers\AlertHelper::renderSweetAlert() !!}
@endsection