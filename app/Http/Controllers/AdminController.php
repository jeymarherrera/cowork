<?php

namespace App\Http\Controllers;
use App\Models\Sala;
use App\Models\Reserva;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Muestra el panel de administración
    public function index()
    {
        $usuarios = User::all();
        $salas = Sala::all();
        $reservas = Reserva::all();
        return view('admin.dashboard', compact('usuarios', 'salas', 'reservas'));
    }
}
