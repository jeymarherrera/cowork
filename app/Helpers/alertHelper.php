<?php

namespace App\Helpers;

class AlertHelper
{
    public static function renderSweetAlert()
    {
        $script = '<script>';

        if (session('success')) {
            $message = session('success');
            $script .= "Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: '$message',
                confirmButtonText: 'Aceptar'
            });";
        }

        if (session('error')) {
            $message = session('error');
            $script .= "Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '$message',
                confirmButtonText: 'Aceptar'
            });";
        }

        $script .= '</script>';

        return $script;
    }

    
}
