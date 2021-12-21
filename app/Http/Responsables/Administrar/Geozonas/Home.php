<?php

namespace App\Http\Responsables\Administrar\Geozonas;

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
            'subtitle'  => 'Geozonas de Control',
            'buscare'   => 'nomb_geozo'
        ];

        return view('administrador.geozonas.vista', compact('data'));
    }
}