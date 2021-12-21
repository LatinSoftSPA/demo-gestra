<?php

namespace App\Modelos\DBServicios;

use App\Modelos\DBServicios\Configuracion;

class ViewProgramasXControlar extends Configuracion
{
    protected $table = 'viewProgramasXControlar';

    public static function _listar($docu_empre, $codi_circu, $codi_servi)
    {
        $listado = ViewProgramasXControlar::where('docu_empre', $docu_empre)
            ->where('codi_circu', $codi_circu)
            ->where('codi_servi', $codi_servi)
            ->get();

        return $listado->toArray();
    }
}
