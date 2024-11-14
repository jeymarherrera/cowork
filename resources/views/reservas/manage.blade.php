@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Gestión de Reservas</h1>
        <form action="{{ route('reservas.manage') }}" method="GET" class="d-flex">
            <select name="sala_id" class="form-control me-2" onchange="this.form.submit()">
                <option value="">Todas las Salas</option>
                @foreach($salas as $sala)
                <option value="{{ $sala->id }}" {{ request('sala_id') == $sala->id ? 'selected' : '' }}>
                    {{ $sala->nombre }}
                </option>
                @endforeach
            </select>
            <noscript><button type="submit" class="btn btn-primary">Filtrar</button></noscript>
        </form>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Sala</th>
                <th>Cliente</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @if(isset($reservas) && $reservas->count() > 0)
            @foreach ($reservas as $reserva)
            <tr>
                <td>{{ $reserva->sala->nombre }}</td>
                <td>{{ $reserva->user->name }}</td>
                <td>{{ $reserva->fecha }}</td>
                <td>{{ $reserva->hora }}</td>
                <td>{{ $reserva->estado }}</td>
                <td>
                    @if($reserva->estado === 'Cancelada')
                    <form action="{{ route('reservas.deleteReserva', $reserva->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                    </form>
                    @else
                    <form action="{{ route('reservas.updateEstado', $reserva->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <select name="estado" class="form-control btn-sm">
                            <option value="Pendiente" {{ $reserva->estado == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                            <option value="Aceptada" {{ $reserva->estado == 'Aceptada' ? 'selected' : '' }}>Aceptada</option>
                            <option value="Rechazada" {{ $reserva->estado == 'Rechazada' ? 'selected' : '' }}>Rechazada</option>
                        </select>
                        <button type="submit" class="btn btn-primary btn-sm">Actualizar</button>
                    </form>
                    @endif
                </td>
            </tr>
            @endforeach
            @else
            <tr>
                <td colspan="6" class="text-center">No hay reservas creadas.</td>
            </tr>
            @endif
        </tbody>
    </table>
</div>

{!! \App\Helpers\AlertHelper::renderSweetAlert() !!}
@endsection