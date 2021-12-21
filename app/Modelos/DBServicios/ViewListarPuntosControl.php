<?php

namespace App\Modelos\DBServicios;

use App\Modelos\DBServicios\Configuracion;

use App\Modelos\DBGestra\Circuito;
use App\Modelos\DBServicios\Ruta;

class ViewListarPuntosControl extends Configuracion
{
    protected $table = 'viewListarPuntosControl';

    public static function _listar($codi_circu, $docu_empre)
    {
        $circuito = Circuito::buscar($codi_circu, $docu_empre);
        $rutas  = Ruta::buscar($codi_circu, $docu_empre);

        $controles = [];
        foreach ($rutas as $ruta) {
            $codi_senti = $ruta['codi_senti'];
            $codi_ruta = $ruta['codi_ruta'];

            $control = self::buscar($codi_circu, $docu_empre, $codi_senti, $codi_ruta);
            array_push($controles, ['codi_senti' => $codi_senti, 'controles' => $control->toArray()]);
        }

        return [
            'circuito'  => $circuito,
            'rutas'     => $rutas,
            'controles' => $controles
        ];
    }

    public static function buscar($codi_circu, $docu_empre, $codi_senti, $codi_ruta)
    {
        return ViewListarPuntosControl::where('codi_circu', $codi_circu)
            ->where('docu_empre', $docu_empre)
            ->where('codi_senti', $codi_senti)
            ->where('codi_ruta', $codi_ruta)
            ->get();
    }
}
