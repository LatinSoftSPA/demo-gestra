<?php

namespace App\Modelos\DBServicios;

use App\Modelos\DBServicios\Configuracion as Model;

use App\Modelos\DBServicios\ViewListarProgramadas;
use App\Modelos\DBServicios\ViewMultasRecaudadas;
use App\Modelos\DBServicios\ViewListarExpediciones;

class ViewListarServicios extends Model
{
    protected $table = 'viewServicios';        //TODO: Cambiar Nombre a la Vista en la DB

    public static function buscar($codi_servi, $codi_circu)
    {
        $objeto = ViewListarServicios::
            where('codi_servi', $codi_servi)->
            where('codi_circu', $codi_circu)->
            limit(1)->
            get();

        return $objeto;
    }

	public static function listar($codi_circu, $docu_empre, $desde, $hasta, $orden)
    {
        $desde = date('Y-m-d H:i:s', $desde);
        $hasta = date('Y-m-d H:i:s', $hasta);  
        $servicios = ViewListarServicios::where('codi_circu', $codi_circu)
            ->where('docu_empre', $docu_empre)
            ->whereBetween('inic_servi', [$desde, $hasta])
            ->orderBy('inic_servi', $orden)
            ->get();

        return $servicios;
    }

    public static function filtrar($nume_movil, $codi_circu, $docu_empre, $desde, $hasta, $orden)
    {
        $desde = date('Y-m-d H:i:s', $desde);
        $hasta = date('Y-m-d H:i:s', $hasta);  
        $servicios = ViewListarServicios::where('nume_movil', $nume_movil)
            ->where('codi_circu', $codi_circu)
            ->where('docu_empre', $docu_empre)
            ->whereBetween('inic_servi', [$desde, $hasta])
            ->orderBy('inic_servi', $orden)
            ->get();

        return $servicios;
    }

    public static function servicio($codi_servi, $codi_circu)
    {
        $servicio       = ViewListarServicios::buscar($codi_servi, $codi_circu);
        $controladas    = ViewListarProgramadas::listar($codi_servi, $codi_circu);
        $multas         = ViewMultasRecaudadas::buscar($codi_servi, $codi_circu);
        $expediciones   = ViewListarExpediciones::listar($codi_servi, $codi_circu);

        $inic_servi     = $servicio[0]['inic_servi'];
        return [
            'inic_servi'    => $inic_servi, 
            'servicio'      => $servicio[0], 
            'controladas'   => $controladas,
            'las_multas'    => $multas,
            'expediciones'  => $expediciones,

            'total'         => $servicio->count()
        ];
    }
}