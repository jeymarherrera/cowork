<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * Las rutas que deben excluirse de la verificación CSRF.
     *
     * @var array
     */
    protected $except = [
        // Aquí puedes agregar rutas específicas que quieras excluir de la verificación CSRF
    ];
}
