<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // // Muestra el perfil del usuario
    // public function show(User $user)
    // {
    //     return view('profile.show', compact('user'));
    // }

    // // Actualiza la información del usuario
    // public function update(Request $request, User $user)
    // {
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|string|email|max:255|unique:users,email,' . $user->id
    //     ]);

    //     $user->update($request->all());
    //     return back()->with('success', 'Profile updated successfully.');
    // }
}
