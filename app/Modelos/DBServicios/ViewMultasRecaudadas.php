<?php

namespace App\Modelos\DBServicios;

use App\Modelos\DBServicios\Configuracion as Model;

class ViewMultasRecaudadas extends Model
{
    protected $table = 'tb_multas';

    public static function _listar($codi_circu, $codi_servi)
    {
        $multas = ViewMultasRecaudadas::where('codi_circu', $codi_circu)
            ->where('codi_servi', $codi_servi)
            ->get();
        
        return $multas;

        /*
        return [
            'multas' => $multas->toArray(),
            'total' => $multas->count()
        ];
        */
    }
}