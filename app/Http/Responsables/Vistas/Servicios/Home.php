<?php

namespace App\Http\Responsables\Vistas\Servicios;

use Illuminate\Contracts\Support\Responsable;

use App\Modelos\DBGestra\Circuito;

class Home implements Responsable
{
    protected $_servicios;

    protected $_docu_empre = '96711420';

    public function __construct($servicios)
    {
        $this->_servicios = $servicios;
    }

    public function toResponse($request)
    {
        $data = [
            'title'         => 'Gestion',
            'subtitle'      => 'Servicios',
            'buscare'       => 'movi_busca',
            'lstCircuitos'  => $this->_listarCircuitos()
        ];
        return view('servicios.vista', compact('data'));
    }

    private function _listarCircuitos()
    {
        return Circuito::orderBy('nomb_circu', 'ASC')
            ->where('habilitado', 1)
            ->pluck('nomb_circu', 'codi_circu')
            ->all();
    }
}