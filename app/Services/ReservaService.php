<?php

namespace App\Services;

use App\Models\Reserva;

class ReservaService
{
    /**
     * Crea una reserva.
     * 
     * @param int $user_id
     * @param int $sala_id
     * @param string $fecha
     * @param string $hora
     * @return Reserva|null
     */
    public function createReserva($user_id, $sala_id, $fecha, $hora)
    {
        // Asumimos que las fechas vienen validadas y en el formato correcto.
        if ($this->isSalaAvailable($sala_id, $fecha, $hora)) {
            return Reserva::create([
                'user_id' => $user_id,
                'sala_id' => $sala_id,
                'fecha' => $fecha,
                'hora' => $hora
            ]);
        }

        return null; // Si la sala no está disponible, retorna null
    }

    /**
     * Verifica si la sala está disponible para reservar.
     *
     * @param int $sala_id
     * @param string $fecha
     * @param string $hora
     * @return bool
     */
    public function isSalaAvailable($sala_id, $fecha, $hora)
    {
        $conflicts = Reserva::where('salaId', $sala_id)
            ->where(function ($query) use ($fecha, $hora) {
                $query->whereBetween('fecha', [$fecha, $hora])
                    ->orWhereBetween('hora', [$fecha, $hora]);
            })
            ->exists();

        return !$conflicts;
    }

    /**
     * Cancela una reserva.
     *
     * @param int $reservaId
     * @return bool
     */
    public function deleteReserva($reservaId)
    {
        $reserva = Reserva::find($reservaId);
        if ($reserva) {
            $reserva->delete();
            return true;
        }

        return false;
    }

    public function cancelReserva($reservaId)
    {
        $reserva = Reserva::find($reservaId);
        if ($reserva->estado != 'Cancelada' || $reserva->estado != 'Rechazada') {
            $reserva->estado = 'Cancelada';
            $reserva->save();
            return true;
        }

        return false;
    }
}
