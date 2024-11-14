<?php

use App\Http\Controllers\ReservaController;
use App\Http\Controllers\SalaController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return redirect()->route('/auth/login');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    //-- reservas
    //cliente
    Route::get('/reservas/create', [ReservaController::class, 'createReserva'])->name('reservas.createReserva');
    Route::post('/reservas', [ReservaController::class, 'storeReserve'])->name('reservas.storeReserva');
    Route::patch('/reservas/{id}/cancelar', [ReservaController::class, 'cancelReserva'])->name('reservas.cancelReserva');


    //ambos
   
    Route::delete('/reservas/{id}/eliminar', [ReservaController::class, 'deleteReserva'])->name('reservas.deleteReserva');
    Route::get('/reservas', [ReservaController::class, 'index'])->name('reservas.index');

    //***admin
    //reservas
    Route::patch('/reservas/{id}/actualizarEstado', [ReservaController::class, 'updateEstado'])->name('reservas.updateEstado');
    //salas
    Route::get('/salas/create', [SalaController::class, 'createSala'])->name('salas.createSala');
    Route::post('/salas', [SalaController::class, 'storeSala'])->name('salas.storeSala');
    Route::get('salas/{id}/editar', [SalaController::class, 'editSala'])->name('salas.editSala');
    Route::patch('salas/{id}/actualizar', [SalaController::class, 'updateSala'])->name('salas.updateSala');
    Route::delete('/salas/{id}/eliminar', [SalaController::class, 'deleteSala'])->name('salas.deleteSala');
});

require __DIR__ . '/auth.php';