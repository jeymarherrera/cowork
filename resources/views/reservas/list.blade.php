@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Mis Reservas</h1>
        <a href="{{ route('reservas.createReserva') }}" class="btn btn-success">
            Nueva Reserva
        </a>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Sala</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Estado</th>
                <!-- <th>Acciones</th> -->
            </tr>
        </thead>
        <tbody>
            @if(isset($reservas) && $reservas->count() > 0)
            @foreach ($reservas as $reserva)
            <tr>
                <td>{{ $reserva->sala->nombre }}</td>
                <td>{{ $reserva->fecha }}</td>
                <td>{{ $reserva->hora }}</td>
                <td>{{ $reserva->estado }}</td>
                <!-- <td>
                    @if($reserva->estado === 'Cancelada' || $reserva->estado === 'Rechazada')
                    <form action="{{ route('reservas.deleteReserva', $reserva->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-secondary btn-sm">Eliminar</button>
                    </form>
                    @endif
                </td> -->
            </tr>
            @endforeach
            @else
            <tr>
                <td colspan="5" class="text-center">No hay reservas creadas.</td>
            </tr>
            @endif
        </tbody>
    </table>
</div>
{!! \App\Helpers\AlertHelper::renderSweetAlert() !!}
@endsection