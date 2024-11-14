@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Gestionar Salas</h1>
        <a href="{{ route('salas.createSala') }}" class="btn btn-success">
            Nueva Sala
        </a>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Sala</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @if(isset($salas) && $salas->count() > 0)
            @foreach ($salas as $sala)
            <tr>
                <td>{{ $sala->nombre }}</td>
                <td>{{ $sala->descripcion }}</td>
                <td>
                    <a href="{{ route('salas.editSala', $sala->id) }}" class="btn btn-primary btn-sm">Editar</a>
                    <form action="{{ route('salas.deleteSala', $sala->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                    </form>
                </td>
            </tr>

            @endforeach
            @else
            <tr>
                <td colspan="3" class="text-center">No hay salas creadas.</td>
            </tr>
            @endif
        </tbody>
    </table>
</div>
{!! \App\Helpers\AlertHelper::renderSweetAlert() !!}
@endsection