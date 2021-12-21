<?php

namespace App\Modelos\DBServicios;

use App\Modelos\DBServicios\Configuracion;

class ViewRutas extends Configuracion
{
    protected $table = 'viewListarRutas';
    
    /*
    public static function _buscar($e, $c, $s)
    {
        try
        {
            $servicio = ViewServicios::where('codi_servi', $s)
                    ->where('codi_circu', $c)
                    ->where('docu_empre', $e)
                    ->limit(1)
                    ->get();
            $total = $servicio->count();

            $servicio = $servicio->toArray();
            $controladas    = ViewProgramadas::_listar($c, $s);
            $expediciones   = ViewExpediciones::_listar($c, $s);
            $multas         = ViewMultasRecaudadas::_listar($c, $s);
            return [
                'servicio'      => $servicio[0],
                'controladas'   => $controladas,
                'expediciones'  => $expediciones,
                'multas'        => $multas,
                'total'         => $total
            ];
        } catch (\Exception $e){
            return response('Error de Comunicacion en el Servidor!!!', 500);
        }
    }
    */
    public static function _listar($docu_empre)
	{
		try
        {
            $listado = ViewRutas::where('docu_empre', $docu_empre)->get();

            return $listado;
        } catch (\Exception $e){
            return response('Error de Comunicacion en el Servidor!!!', 500);
        }
	}

    public static function _filtrar($nomb_ruta, $docu_empre)
    {
        try
        {
            $listado = ViewRutas::where('docu_empre', $docu_empre)->where('nomb_ruta', 'LIKE', "%$nomb_ruta%")->get();

            return $listado;
        } catch (\Exception $e){
            return response('Error de Comunicacion en el Servidor!!!', 500);
        }
    }
}