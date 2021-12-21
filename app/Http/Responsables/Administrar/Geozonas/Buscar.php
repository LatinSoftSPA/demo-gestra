<?php

namespace App\Http\Responsables\Administrar\Geozonas;

use Illuminate\Contracts\Support\Responsable;

use App\Modelos\DBGts\ViewGeozonas;

class Buscar implements Responsable
{
    protected $_geozoneID;

    public function __construct($request)
    {
        $this->_geozoneID = $request->geozoneID;
    }

    public function toResponse($request)
    {
        $geozoneID = $this->_geozoneID;

        try{
            $lst = ViewGeozonas::_buscar($geozoneID);
            return response()->json([
                'listado' => $lst->all(),
                'total' => $lst->count()
            ], 200);
        } catch (\Exception $e){
            return response('Algo salio mal...!!!', 500);
        }
    }
}