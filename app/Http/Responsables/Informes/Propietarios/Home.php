<?php

namespace App\Http\Responsables\Informes\Propietarios;

use Illuminate\Contracts\Support\Responsable;
/*
use App\Modelos\Vistas\ViewListarProgramadas;
use App\Modelos\Vistas\ViewListarExpediciones;
*/

use App\Modelos\DBGestra\ViewPropietarios;
use App\Modelos\DBGestra\ViewMoviles;

use App\Modelos\DBServicios\ViewServicios;

class Home implements Responsable
{
    protected $_codi_linea;
    protected $_docu_empre = '96711420';
    protected $_docu_perso;

    public function __construct($request)
    {
        $this->_codi_linea = $request->codi_linea;
        //$this->_docu_empre = $request->docu_empre;
        $this->_docu_perso = $request->docu_perso;
    }

    public function toResponse($request)
    {
        $codi_linea = $this->_codi_linea;
        $docu_empre = $this->_docu_empre;
        $docu_perso = $this->_docu_perso;

        $misDatos = $this->_datosPropietario($docu_empre, $docu_perso);
        $misMoviles = $this->_losMoviles($docu_empre, $docu_perso);

        $laFlota = [];
        $losMoviles = [];
        foreach ($misMoviles as $obj) {
            $nume_movil = $obj->nume_movil;
            $pate_movil = $obj->pate_movil;
            $codi_equip = $obj->codi_equip;

            // $desde = strtotime(date("Y-n-j", strtotime("01-09-2021")));
            // $hasta = strtotime(date("Y-n-j", strtotime("31-09-2021")));
            $desde = strtotime(date("Y-n-j", strtotime("first day of this month")));
            $hasta = strtotime(date("Y-n-j", strtotime("last day of this month")));

            $losServicios = $this->_losServicios($nume_movil, $pate_movil, $desde, $hasta);

            $obj->misServicios = $losServicios->toArray();
            array_push($losMoviles, ['codi_equip' => $codi_equip, 'nume_movil' => $nume_movil, 'pate_movil' => $pate_movil]);
            array_push($laFlota, $obj);
        }

        $data = [
            'title'     => 'Manager',
            'subtitle'  => 'Sistema de Gestion'
        ];
        return view('informes.propietarios.flota.vista', compact('misDatos', 'laFlota', 'losMoviles', 'data'));
    }





    private function _datosPropietario($docu_empre, $docu_perso)
    {
        return ViewPropietarios::where('docu_empre', $docu_empre)->where('docu_perso', $docu_perso)->get();
    }

    private function _losMoviles($docu_empre, $docu_perso)
    {
        return ViewMoviles::where('docu_empre', $docu_empre)->where('docu_perso', $docu_perso)->get();
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
