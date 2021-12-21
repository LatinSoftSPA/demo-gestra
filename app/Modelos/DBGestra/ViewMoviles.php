<?php

namespace App\Modelos\DBGestra;

use App\Modelos\DBGestra\Configuracion;

class ViewMoviles extends Configuracion
{
    protected $table = 'viewListarMoviles';

	public static function _buscar($docu_empre, $nume_movil)
	{
		try
		{
			$movil = ViewMoviles::where('nume_movil', $nume_movil)
	            ->where('docu_empre', $docu_empre)
	            ->limit(1)
	            ->get();
			return $movil;
        } catch (\Exception $e){
            return response('Algo salio mal...!!!', 500);
        }
	}

    public static function _listar($docu_empre)
    {
        try
        {
            $listado = ViewMoviles::where('docu_empre', $docu_empre)
                ->orderBy('nume_movil')
                ->get();

            return $listado; 
        } catch (\Exception $e){
            return response('Algo salio mal...!!!', 500);
        }
    }
	
    public static function _filtrar($docu_empre, $pate_movil)
    {
        try{
            $listado = ViewMoviles::where('pate_movil', 'LIKE', "%$pate_movil%")->where('docu_empre', $docu_empre)->get();
            
            return $listado;
        } catch (\Exception $e){
            return response('Algo salio mal...!!!', 500);
        }
    }
}