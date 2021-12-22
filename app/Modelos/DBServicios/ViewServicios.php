<?php

namespace App\Modelos\DBServicios;

use App\Modelos\DBServicios\Configuracion;

use App\Modelos\DBServicios\viewProgramasXControlar;
use App\Modelos\DBServicios\ViewExpediciones;
use App\Modelos\DBServicios\ViewMultasRecaudadas;

class ViewServicios extends Configuracion
{
    protected $table = 'viewServicios';

    public static function _buscar($docu_empre, $codi_circu, $codi_servi)
    {
        try {
            $servicio = ViewServicios::where('docu_empre', $docu_empre)
                ->where('codi_circu', $codi_circu)
                ->where('codi_servi', $codi_servi)
                ->limit(1)
                ->get();
            $servicio = $servicio->toArray();

            $expediciones   = ViewExpediciones::_listar($codi_circu, $codi_servi);
            $multas         = ViewMultasRecaudadas::_listar($codi_circu, $codi_servi);
            $controladas    = viewProgramasXControlar::_listar($docu_empre, $codi_circu, $codi_servi);
            return [
                'servicio'      => $servicio[0],
                'controladas'   => $controladas,
                'expediciones'  => $expediciones,
                'multas'        => $multas,
                'total'         => $servicio->count()
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
