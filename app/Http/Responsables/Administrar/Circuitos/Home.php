<?php

namespace App\Http\Responsables\Administrar\Circuitos;

use Illuminate\Contracts\Support\Responsable;

class Home implements Responsable
{
    public function __construct($request)
    {
    }

    public function toResponse($request)
    {
        $data = [
            'title'     => 'Administracion',
            'subtitle'  => 'Circuitos',
            'buscare'   => 'nomb_circu'
        ];
        return view('administrador.circuitos.vista', compact('data'));
    }
}