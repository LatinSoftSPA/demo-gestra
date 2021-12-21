<?php

namespace App\Modelos\DBGestra;

use App\Modelos\DBGestra\Configuracion as Model;

class ViewCircuitos extends Model
{
    protected $table = 'viewCircuitos';
/*
	public static function _buscar($docu_empre, $codi_licen)
	{
		try
		{
			$conductor = ViewCircuitos::where('codi_licen', $codi_licen)
	            ->where('docu_empre', $docu_empre)
	            ->limit(1)
	            ->get();

	        return $conductor; 
        } catch (\Exception $e){
            return response('Algo salio mal...!!!', 500);
        }
	}
*/
    public static function _listar($docu_empre)
    {
        try
        {
            $listado = ViewCircuitos::where('docu_empre', $docu_empre)
				->orderBy('codi_circu', 'ASC')
				->get();

            return $listado; 
        } catch (\Exception $e){
            return response('Algo salio mal...!!!', 500);
        }
    }

    public static function _filtrar($docu_empre, $nomb_circu)
    {
        try{
            $listado = ViewCircuitos::where('docu_empre', $docu_empre)->where('nomb_circu', 'LIKE', "%$nomb_circu%")->get();
            
            return $listado;
        } catch (\Exception $e){
            return response('Algo salio mal...!!!', 500);
        }
    }
}