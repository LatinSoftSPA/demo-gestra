<?php

namespace App\Http\Responsables\Manager\Servicios;

use Illuminate\Contracts\Support\Responsable;

use App\Modelos\DBGestra\Circuito;

class Home implements Responsable
{

    public function __construct($request)
    {
    }

    public function toResponse($request)
    {
        $data = [
            'title'         => 'Manager',
            'subtitle'      => 'Servicios',
            'buscare'       => 'movi_busca',
            'lstCircuitos'  => $this->_listarCircuitos()
        ];
        return view('manager.servicios.vista', compact('data'));
    }

    private function _listarCircuitos()
    {
        return Circuito::orderBy('nomb_circu', 'ASC')
            ->where('habilitado', 1)
            ->pluck('nomb_circu', 'codi_circu')
            ->all();
    }
}