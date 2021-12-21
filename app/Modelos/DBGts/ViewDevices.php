<?php

namespace App\Modelos\DBGts;

use App\Modelos\DBGts\Configuracion as Model;

class ViewDevices extends Model
{
	protected $table = 'Device';

    public static function _listar($accountID, $groupID)
    {
        try
        {
            $listado = ViewDevices::where('accountID', $accountID)
                ->where('groupID', $groupID)
                ->orderBy('deviceID', 'ASC')
                ->get();

            return $listado; 
        } catch (\Exception $e){
            return response('Algo salio mal...!!!', 500);
        }
    }

    public static function _filtrar($accountID, $groupID, $imeiNumber)
    {
        try{
            $listado = ViewDevices::where('accountID', $accountID)
                ->where('groupID', $groupID)
                ->where('imeiNumber', 'LIKE', "%$imeiNumber%")
                ->get();
            return $listado;
        } catch (\Exception $e){
            return response('Algo salio mal...!!!', 500);
        }
    }
}