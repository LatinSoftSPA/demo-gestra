<?php

namespace App\Http\Responsables\Administrar\Rutas;

use Illuminate\Contracts\Support\Responsable;

class Home implements Responsable
{
    public function __construct($request)
    {
    }

    public function toResponse($request)
    {
        $data = 
        [
            'title'     => 'Administracion',
            'subtitle'  => 'Rutas',
            'buscare'   => 'nomb_ruta'
        ];

        return view('administrador.rutas.vista', compact('data'));
    }
}