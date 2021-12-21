<?php

namespace App\Http\Responsables\Manager\Moviles;

use Illuminate\Contracts\Support\Responsable;

use App\Modelos\DBGestra\ViewMoviles;

class Listar implements Responsable
{
    protected $_docu_empre = '11222333';

    public function __construct($request)
    {
    }

    public function toResponse($request)
    {
        $docu_empre = $this->_docu_empre;
        $listado = ViewMoviles::where('docu_empre', $docu_empre)->get();

        if ($listado->count() > 0) {
            return response()->json([
                'listado' => $listado->toArray(),
                'total' => $listado->count()
            ], 200);
        } else {
            return response('No se Encontraron Conductores para esta empresa.', 404);
        }
    }
}
