<?php

namespace App\Modelos\DBServicios;

use App\Modelos\DBServicios\Configuracion;

use App\Modelos\DBServicios\viewProgramasXControlar;
use App\Modelos\DBServicios\ViewExpediciones;
use App\Modelos\DBServicios\ViewMultasRecaudadas;

class ViewServicios extends Configuracion
{
    protected $table = 'viewServicios';

    public static function _buscar($e, $c, $s)
    {
        try {
            $servicio = ViewServicios::where('codi_servi', $s)
                ->where('codi_circu', $c)
                ->where('docu_empre', $e)
                ->limit(1)
                ->get();
            $total = $servicio->count();

            $servicio = $servicio->toArray();
		
            $controladas    = viewProgramasXControlar::_listar($e, $c, $s);
            $expediciones   = ViewExpediciones::_listar($c, $s);
            $multas         = ViewMultasRecaudadas::_listar($c, $s);

            return [
                'servicio'      => $servicio[0],
                'controladas'   => $controladas,
                'expediciones'  => $expediciones,
                'multas'        => $multas,
                'total'         => $total
            ];
        } catch (\Exception $e) {
            return response('Error de Comunicacion en el Servidor!!!', 500);
        }
    }

    public static function _listar($e, $c, $d, $h, $o)
    {
        try {
            $listado = ViewServicios::where('codi_circu', $c)
                ->where('docu_empre', $e)
                ->whereBetween('inic_servi', [$d, $h])
                ->orderBy('inic_servi', $o)
                ->get();

            return $listado;
        } catch (\Exception $e) {
            return response('Error de Comunicacion en el Servidor!!!', 500);
        }
    }

    public static function _filtrar($e, $c, $d, $h, $m, $o)
    {
        try {
            $listado = ViewServicios::where('codi_circu', $c)
                ->where('docu_empre', $e)
                ->where('nume_movil', $m)
                ->whereBetween('inic_servi', [$d, $h])
                ->orderBy('inic_servi', $o)
                ->get();

            return $listado;
        } catch (\Exception $e) {
            return response('Error de Comunicacion en el Servidor!!!', 500);
        }
    }
}
