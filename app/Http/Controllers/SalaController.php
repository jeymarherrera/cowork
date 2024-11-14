<?php

namespace App\Http\Controllers;

use App\Services\SalaService;
use App\Models\Reserva;
use App\Models\Sala;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SalaController extends Controller
{
    protected $salaService;

    public function __construct(SalaService $salaService)
    {
        $this->salaService = $salaService;
    }

    
    // Muestra la lista de todas las salas
    public function index()
    {
        $salas = $this->salaService->getAllSalas();
        return view('salas.index', compact('salas'));
    }

    // Muestra el formulario para crear una nueva sala
    public function create()
    {
        return view('salas.create');
    }

    // Almacena una nueva sala en la base de datos
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string|max:500',
        ]);

        $this->salaService->createSala($validated);
        return redirect()->route('salas.index')->with('success', 'Sala creada correctamente.');
    }

    // Muestra la vista para editar una sala existente
    public function edit(Sala $sala)
    {
        return view('salas.edit', compact('sala'));
    }

    // Actualiza una sala en la base de datos
    public function update(Request $request, Sala $sala)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string|max:500',
        ]);

        $sala = $this->salaService->updateSala($sala, $validated);
        return redirect()->route('salas.index')->with('success', 'Sala actualizada correctamente.');
    }

    // Elimina una sala de la base de datos
    public function destroy(Sala $sala)
    {
        $this->salaService->deleteSala($sala);
        return redirect()->route('salas.index')->with('success', 'Sala eliminada exitosamente.');
    }

    //anteriores
    // public function deleteSala($id)
    // {
    //     $sala = Sala::findOrFail($id);

    //     if ($sala->reservas->count() === 0) {
    //         $sala->delete();
    //         return back()->with('success', 'Reserva eliminada exitosamente.');
    //     }
    //     else {
    //         return back()->with('error', 'No se pudo eliminar la sala, ya que tiene reservaciones registadas.');
    //     }

    // }

    // public function index()
    // {
    //     if (Auth::user()->role === 'admin') {
    //         $salas = Sala::all();
    //         return view('salas.index', compact('salas'));
    //     } else {
    //         return view('dashboard');
    //     }
    // }

    // public function editSala($id)
    // {
    //     $sala = Sala::findOrFail($id);
    //     return view('salas.edit', compact('sala'));
    // }

    // public function updateSala(Request $request, $id)
    // {
    //     $request->validate([
    //         'nombre' => 'required|string|max:255',
    //         'descripcion' => 'nullable|string|max:500',
    //     ]);

    //     $sala = Sala::findOrFail($id);
    //     $sala->nombre = $request->input('nombre');
    //     $sala->descripcion = $request->input('descripcion');
    //     $sala->save();

    //     return redirect()->route('salas.index')->with('success', 'Sala actualizada correctamente.');
    // }
}
