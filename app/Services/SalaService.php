<?php

namespace App\Services;

use App\Models\Sala;

class SalaService
{
    public function getAllSalas()
    {
        return Sala::all();
    }

    public function createSala($data)
    {
        return Sala::create($data);
    }

    public function updateSala(Sala $sala, $data)
    {
        $sala->update($data);
        return $sala;
    }

    public function deleteSala(Sala $sala)
    {
        $sala->delete();
    }
}
