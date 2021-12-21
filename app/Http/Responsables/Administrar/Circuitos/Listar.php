<?php

namespace App\Http\Responsables\Administrar\Circuitos;

use Illuminate\Contracts\Support\Responsable;

use App\Modelos\DBGestra\ViewCircuitos;

class Listar implements Responsable
{
    protected $_docu_empre = '11222333';

    public function __construct($request)
    {
    }

    public function toResponse($request)
    {
        $docu_empre = $this->_docu_empre;
        try {
            $lst = ViewCircuitos::_listar($docu_empre);
            return response()->json([
                'listado' => $lst->all(),
                'total' => $lst->count()
            ], 200);
        } catch (\Exception $e) {
            return response('Algo salio mal...!!!', 500);
        }
    }
}
