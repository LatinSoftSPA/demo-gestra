<?php

namespace App\Http\Responsables\Manager\Equipos;

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
            'title'     => 'Manager',
            'subtitle'  => 'Equipo (Device)',
            'buscare'   => 'nume_imei',
        ];

        return view('manager.equipos.vista', compact('data'));
    }
}