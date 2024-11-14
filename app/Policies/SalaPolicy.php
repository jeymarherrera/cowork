<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Sala;
use Illuminate\Auth\Access\HandlesAuthorization;

class SalaPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any rooms.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        // Suponemos que cualquier usuario autenticado puede ver las salas
        return true;
    }

    /**
     * Determine whether the user can view the room.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Room  $room
     * @return mixed
     */
    public function view(User $user, Sala $sala)
    {
        // Cualquier usuario puede ver detalles de las salas
        return true;
    }

    /**
     * Determine whether the user can create rooms.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        // Solo usuarios con un rol específico pueden crear salas
        return $user->isAdmin;
    }

    /**
     * Determine whether the user can update the room.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Room  $room
     * @return mixed
     */
    public function update(User $user, Sala $sala)
    {
        // Solo administradores pueden actualizar salas
        return $user->isAdmin;
    }

    /**
     * Determine whether the user can delete the room.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Room  $room
     * @return mixed
     */
    public function delete(User $user, Sala $sala)
    {
        // Solo administradores pueden eliminar salas
        return $user->isAdmin;
    }

    /**
     * Determine whether the user can restore the room.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Room  $room
     * @return mixed
     */
    public function restore(User $user, Sala $sala)
    {
        // Permitir a los administradores restaurar salas
        return $user->isAdmin;
    }

    /**
     * Determine whether the user can permanently delete the room.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Room  $room
     * @return mixed
     */
    public function forceDelete(User $user, Sala $sala)
    {
        // Solo administradores pueden eliminar permanentemente salas
        return $user->isAdmin;
    }
}
