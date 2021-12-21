<?php

namespace App\Http\Responsables\Recaudaciones\Estadisticas;

use Illuminate\Contracts\Support\Responsable;

use App\Modelos\DBLatinsoft\ViewUsuarios;

class Home implements Responsable
{
    protected $_docu_empre = '96711420';

    public function __construct($request)
    {
    }

    public function toResponse($request)
    {
        $data = [
            'title'     => 'Recaudaciones',
            'subtitle'  => 'Estadisticas',
            'lstUsuarios'   => $this->_listarRecaudadores($this->_docu_empre)
        ];
        return view('recaudaciones.vista', compact('data'));
    }

    private function _listarRecaudadores($e)
    {
        return ViewUsuarios::where('docu_empre', $e)
            //->where('activo', true)
            ->pluck('prim_nombr', 'docu_perso')
            ->all();
    }
}