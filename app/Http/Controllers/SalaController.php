<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Models\Sala;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SalaController extends Controller
{

    public function index()
    {
        if (Auth::user()->role === 'admin') {
            $salas = Sala::all();
            return view('salas.manage', compact('salas'));
        } else {
            return view('dashboard');
        }
    }

    public function createSala()
    {
        return view('salas.create');
    }

    public function editSala($id)
    {
        $sala = Sala::findOrFail($id);
        return view('salas.edit', compact('sala'));
    }

    public function storeSala(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string|max:500',
        ]);

        Sala::create([
            'nombre' => $request->input('nombre'),
            'descripcion' => $request->input('descripcion'),
        ]);

        return redirect()->route('salas.manage')->with('success', 'Sala creada correctamente.');
    }

    public function updateSala(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string|max:500',
        ]);

        $sala = Sala::findOrFail($id);
        $sala->nombre = $request->input('nombre');
        $sala->descripcion = $request->input('descripcion');
        $sala->save();

        return redirect()->route('salas.manage')->with('success', 'Sala actualizada correctamente.');
    }

    public function deleteSala($id)
    {
        $sala = Sala::findOrFail($id);

        if ($sala->reservas->count() === 0) {
            $sala->delete();
            return back()->with('success', 'Reserva eliminada exitosamente.');
        }
        else {
            return back()->with('error', 'No se pudo eliminar la sala, ya que tiene reservaciones registadas.');
        }

    }

}
