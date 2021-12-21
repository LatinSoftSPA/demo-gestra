<?php

namespace App\Http\Responsables\Informes\Conductores;

use Illuminate\Contracts\Support\Responsable;

use App\Modelos\DBServicios\ViewProgramadas;
use App\Modelos\DBServicios\ViewServicios;

class Home implements Responsable
{
    protected $_docu_empre = '96711420';
    protected $_codi_servi;
    protected $_codi_circu;

    public function __construct($request)
    {
        $this->_codi_servi = $request->codi_servi;
        $this->_codi_circu = $request->codi_circu;
    }

    public function toResponse($request)
    {
        $docu_empre = $this->_docu_empre;
        $codi_servi = $this->_codi_servi;
        $codi_circu = $this->_codi_circu;

        $miServicio = $this->_elServicio($codi_circu, $codi_servi);
        if($miServicio->count() > 0)
        {
            $misProgramadas = $this->_lasProgramadas($codi_circu, $codi_servi);
            $tuServicio = $this->_elServicio($codi_circu, $miServicio[0]['serv_anter']);
            $tusProgramadas = $this->_lasProgramadas($codi_circu, $miServicio[0]['serv_anter']);

            return view('informes.miServicio.vista', compact('miServicio', 'misProgramadas', 'tuServicio', 'tusProgramadas'));
        }

        return response()->view('errors.404', [], 404);
    }

    private function _elServicio($codi_circu, $codi_servi)
    {
        return ViewServicios::
            where('codi_servi', $codi_servi)->
            where('codi_circu', $codi_circu)->
            get();
    }

    private function _lasProgramadas($codi_circu, $codi_servi)
    {
        return ViewProgramadas::
            where('codi_circu', $codi_circu)->
            where('codi_servi', $codi_servi)->
            get();
    }

    private function _losServicios($nume_movil, $pate_movil, $desde, $hasta)
    {
        return ViewServicios::where('nume_movil', $nume_movil)
            ->where('pate_movil', $pate_movil)
            ->whereBetween('codi_servi', [$desde, $hasta])
            ->orderBy('inic_servi', 'ASC')
            ->get();
    }
}