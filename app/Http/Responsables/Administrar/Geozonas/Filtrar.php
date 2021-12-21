<?php

namespace App\Http\Responsables\Administrar\Geozonas;

use Illuminate\Contracts\Support\Responsable;

use App\Modelos\DBGts\ViewGeozonas;

class Filtrar implements Responsable
{
    protected $_nomb_geozo;

    public function __construct($request)
    {
        $this->_nomb_geozo = $request->nomb_geozo;
    }

    public function toResponse($request)
    {
        $nomb_geozo = $this->_nomb_geozo;
        try{
            $lst = ViewGeozonas::_filtrar($nomb_geozo);

            if($lst->count() > 0){
                return response()->json([
                        'listado'   => $lst->toArray(),
                        'total'     => $lst->count()
                ], 200);
            } else {
                return response('Nota: No se Encontraron GeoZonas Definidas.', 404);
            }
            
        } catch (\Exception $e){
                return response('Algo salio mal...!!!', 500);
        }
    }
}