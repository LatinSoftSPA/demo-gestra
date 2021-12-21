<?php

namespace App\Modelos\DBServicios;

use App\Modelos\DBServicios\Configuracion;

class ViewExpediciones extends Configuracion
{
    protected $table = 'viewListarExpediciones';

    public static function _listar($codi_circu, $codi_servi)
    {
        $expediciones = ViewExpediciones::where('codi_circu', $codi_circu)
            ->where('codi_servi', $codi_servi)
            ->get();

        return $expediciones->toArray();
    }
}