@extends('layouts.app')

@section('content')
<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Crear una Sala</h1>
        <a href="{{ route('dashboard') }}" class="btn btn-success">
            Volver a Dashboard
        </a>
    </div>

    <div class="card mt-4">
        <div class="card-body">
            <form action="{{ route('salas.storeSala') }}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" required>
                    @error('nombre')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="form-group mb-3">
                    <label for="descripcion">Descripción</label>
                    <textarea name="descripcion" id="descripcion" class="form-control"></textarea>
                    @error('descripcion')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>    

                <button type="submit" class="btn btn-primary">Crear</button>
            </form>
        </div>
    </div>
</div>
{!! \App\Helpers\AlertHelper::renderSweetAlert() !!}
@endsection
