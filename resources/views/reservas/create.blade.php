@extends('layouts.app')

@section('content')
<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Crear una Reserva</h1>
        <a href="{{ route('reservas.list') }}" class="btn btn-success">
            Mis Reservas
        </a>
    </div>

    <div class="card mt-4">
        <div class="card-body">
            <form action="{{ route('reservas.storeReserva') }}" method="POST">
                @csrf
                @if(isset($salas) && $salas->count() > 0)
                <div class="form-group mb-3">
                    <label for="sala_id">Sala de Coworking</label>
                    <select name="sala_id" id="sala_id" class="form-control" required>
                        <option value="">Seleccione una sala</option>
                        @foreach($salas as $sala)
                        <option value="{{ $sala->id }}">{{ $sala->nombre }}</option>
                        @endforeach
                    </select>
                    @error('sala_id')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                @else
                <p>No hay salas disponibles.</p>
                @endif
                <div class="form-group mb-3">
                    <label for="fecha">Fecha de la Reserva</label>
                    <input type="date" name="fecha" id="fecha" class="form-control" required min="{{ date('Y-m-d') }}">
                    @error('fecha')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="hora">Hora de la Reserva</label>
                    <select name="hora" id="hora" class="form-control" required>
                        <option value="">Seleccione una hora</option>
                        @for ($i = 0; $i < 24; $i++)
                            <option value="{{ sprintf('%02d:00', $i) }}">{{ sprintf('%02d:00', $i) }}</option>
                            @endfor
                    </select>
                    @error('hora')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Reservar</button>
            </form>
        </div>
    </div>
</div>
{!! \App\Helpers\AlertHelper::renderSweetAlert() !!}
@endsection