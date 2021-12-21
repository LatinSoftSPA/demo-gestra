<?php

namespace App\Modelos\DBGestra;

use App\Modelos\DBGestra\Configuracion as Model;

class ViewConductores extends Model
{
    protected $table = 'viewListarConductores';

	public static function _buscar($docu_empre, $codi_licen)
	{
		try
		{
			$conductor = ViewConductores::where('codi_licen', $codi_licen)
	            ->where('docu_empre', $docu_empre)
	            ->limit(1)
	            ->get();

	        return $conductor; 
        } catch (\Exception $e){
            return response('Algo salio mal...!!!', 500);
        }
	}

    public static function _listar($docu_empre)
    {
        try
        {
            $listado = ViewConductores::where('docu_empre', $docu_empre)
                ->orderBy('apel_pater')
                ->get();

            return $listado; 
        } catch (\Exception $e){
            return response('Algo salio mal...!!!', 500);
        }
    }
	
    public static function _filtrar($docu_empre, $apel_pater)
    {
        try{
            $listado = ViewConductores::where('apel_pater', 'LIKE', "%$apel_pater%")->where('docu_empre', $docu_empre)->get();
            
            return $listado;
        } catch (\Exception $e){
            return response('Algo salio mal...!!!', 500);
        }
    }
}