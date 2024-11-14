<?php

namespace App\Http\Controllers;

use App\Models\Sala;
use App\Models\Reserva;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservaController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::user()->role === 'admin') {
            $salas = Sala::all();

            $salaId = $request->input('sala_id');

            $reservas = Reserva::with('sala', 'user')
            ->when($salaId, function ($query, $salaId) {
                return $query->where('sala_id', $salaId);
            })
            ->get();
            return view('reservas.manage', compact('reservas', 'salas'));
        } else {
            $reservas = Reserva::where('user_id', Auth::id())->with('sala')->get();
            return view('reservas.list', compact('reservas'));
        }
    }


    public function createReserva()
    {
        $salas = Sala::all();
        return view('reservas.create', compact('salas'));
    }

    public function storeReserva(Request $request)
    {
        $request->validate([
            'sala_id' => 'required|exists:salas,id',
            'fecha' => 'required|date',
            'hora' => 'required|date_format:H:i',
        ]);

        $conflicto = Reserva::where('sala_id', $request->sala_id)
            ->where('fecha', $request->fecha)
            ->where('hora', $request->hora)
            ->whereNotIn('estado', ['Cancelada', 'Rechazada'])
            ->exists();

        if ($conflicto) {
            return back()->with('error', 'Esta sala ya está reservada en el horario seleccionado.');
        }

        Reserva::create([
            'user_id' => Auth::id(),
            'sala_id' => $request->sala_id,
            'fecha' => $request->fecha,
            'hora' => $request->hora,
            'estado' => 'Pendiente',
        ]);

        return redirect()->route('reservas.list')->with('success', 'Reserva creada exitosamente.');
    }

    public function updateEstado(Request $request, $id)
    {
        $request->validate([
            'estado' => 'required|in:Pendiente,Aceptada,Rechazada',
        ]);

        $reserva = Reserva::findOrFail($id);

        $reserva->estado = $request->estado;
        $reserva->save();

        return redirect()->back()->with('success', 'Estado de la reserva actualizado correctamente.');
    }


    public function cancelReserva($id)
    {
        $reserva = Reserva::findOrFail($id);

        if ($reserva->estado === 'Rechazada') {
            return back()->with('error', 'La reserva ya está rechazada.');
        }

        $reserva->estado = 'Cancelada';
        $reserva->save();

        return back()->with('success', 'Reserva cancelada exitosamente.');
    }

    public function deleteReserva($id)
    {
        $reserva = Reserva::findOrFail($id);

        if ($reserva->estado === 'Cancelada' || $reserva->estado === 'Rechazada') {
            $reserva->delete();
            return back()->with('success', 'Reserva eliminada exitosamente.');
        }

        return back()->with('error', 'No se pudo eliminar la reserva.');
    }
}
