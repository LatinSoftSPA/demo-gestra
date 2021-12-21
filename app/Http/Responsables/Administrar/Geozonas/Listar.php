<?php

namespace App\Http\Responsables\Administrar\Geozonas;

use Illuminate\Contracts\Support\Responsable;

use App\Modelos\DBGts\ViewGeozonas;

class Listar implements Responsable
{
    protected $_accountID = 'lineas-cur';

    public function __construct($request)
    {
    }

    public function toResponse($request)
    {
        try {
            $lst = ViewGeozonas::_listar($this->_accountID)->get();
            return response()->json([
                'listado' => $lst->toArray(),
                'total' => $lst->count()
            ], 200);
        } catch (\Exception $e) {
            return response('Algo salio mal...!!!', 500);
        }
    }
}
