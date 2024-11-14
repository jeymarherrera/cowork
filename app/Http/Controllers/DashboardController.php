<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Models\Sala;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    

    public function index(Request $request)
    {
        $salas = Sala::all();

        $salaId = $request->input('sala_id');

        if (Auth::user()->role === 'admin') {

            $reservas = Reserva::with('sala', 'user')
                ->when($salaId, function ($query, $salaId) {
                    return $query->where('sala_id', $salaId);
                })
                ->get();
        } else {
            $reservas = Reserva::where('user_id', Auth::id())->with('sala')->get();
        }

        return view('dashboard', compact('reservas', 'salas'));
    }
}