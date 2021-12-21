<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Modelos\Vistas\ViewListarServicios;
use App\Modelos\Vistas\ViewListarProgramadas;

use App\Modelos\Servicio;
use App\Modelos\Expedicion;
use App\Modelos\Programada;

class MonitoresController extends Controller
{

    public function index($docu_empre, $codi_circu)
    {
        $data = 
        [
            'title'     => 'Frecuencia del Servicio',
            'subtitle'  => '',
            'listado'   => $this->_listarServicios($docu_empre, $codi_circu),
            'codi_circu'=> $codi_circu,
        ];

        return view('monitores.vista', compact('data'));
    }

    private function _listarServicios($docu_empre, $codi_circu)
    {
        $desde = strtotime(date("Y-m-d 00:00:00"));
        $hasta = strtotime(date("Y-m-d 23:59:59"));

        return ViewListarServicios::where('codi_circu', $codi_circu)
                    ->where('docu_empre', $docu_empre)
                    ->whereBetween('codi_servi', [$desde, $hasta])
                    ->limit(22)
                    ->get();
    }
}