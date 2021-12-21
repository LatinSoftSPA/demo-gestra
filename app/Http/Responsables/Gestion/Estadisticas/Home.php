<?php

namespace App\Http\Responsables\Gestion\Estadisticas;

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
            'title'         => 'Gestion',
            'subtitle'      => 'Estadisticas',
            'buscare'       => '',
            'lstCircuitos'  => $this->_listarCircuitos()
        ];
        return view('estadisticas.vista', compact('data'));
    }

    private function _listarCircuitos()
    {
        return Circuito::orderBy('nomb_circu', 'ASC')
            ->where('habilitado', 1)
            ->pluck('nomb_circu', 'codi_circu')
            ->all();
    }
}