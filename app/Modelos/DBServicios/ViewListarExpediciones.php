<?php

namespace App\Modelos\DBServicios;

use App\Modelos\DBServicios\Configuracion as Model;

class ViewListarExpediciones extends Model
{
    protected $table = 'viewListarExpediciones';

    public static function listar($codi_servi, $codi_circu)
    {
        $objeto = ViewListarExpediciones::where('codi_servi', $codi_servi)
            ->where('codi_circu', $codi_circu)
            ->get();

        return $objeto->toArray();
    }
}