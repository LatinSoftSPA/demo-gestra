<?php

namespace App\Modelos\DBServicios;

use App\Modelos\DBServicios\Configuracion as Model;

class ViewServiciosDiariosXMovil extends Model
{
    protected $table = 'viewServiciosDiariosXMovil';

    public static function _listar($e, $c, $d, $h)
	{
		try
        {
            $listado = ViewServiciosDiariosXMovil::where('codi_circu', $c)
                ->where('docu_empre', $e)
                ->whereBetween('inic_servi', [$d, $h])
                ->get();

            return $listado;
        } catch (\Exception $e){
            return response('Error de Comunicacion en el Servidor!!!', 500);
        }
	}
}