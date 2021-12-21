<?php

namespace App\Modelos\DBGestra;

use App\Modelos\DBGestra\Configuracion as Model;

class ViewPropietarios extends Model
{	
    protected $table = 'viewListarPropietarios';
	
    public static function _listar($docu_empre)
    {
        try
        {
            $listado = ViewPropietarios::where('docu_empre', $docu_empre)
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
            $listado = ViewPropietarios::where('apel_pater', 'LIKE', "%$apel_pater%")->where('docu_empre', $docu_empre)->get();
            
            return $listado;
        } catch (\Exception $e){
            return response('Algo salio mal...!!!', 500);
        }
    }
}