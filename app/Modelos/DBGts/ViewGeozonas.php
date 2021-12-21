<?php

namespace App\Modelos\DBGts;

use App\Modelos\DBGts\Configuracion as Model;

class ViewGeozonas extends Model
{
    protected $table = 'viewGeozonas';

    public static function _buscar($geozoneID)
    {
        try {
            $listado = ViewGeozonas::where('geozoneID', $geozoneID)->get();

            return $listado;
        } catch (\Exception $e) {
            return response('Algo salio mal...!!!', 500);
        }
    }

    public static function _listar($accountID)
    {
        try {
            $listado = ViewGeozonas::where('accountID', $accountID)->get();

            return $listado;
        } catch (\Exception $e) {
            return response('Algo salio mal...!!!', 500);
        }
    }

    public static function _filtrar($nomb_geozo)
    {
        try {
            $listado = ViewGeozonas::where('description', 'LIKE', "%$nomb_geozo%")->get();

            return $listado;
        } catch (\Exception $e) {
            return response('Algo salio mal...!!!', 500);
        }
    }
}
