<?php

namespace App\Http\Responsables\Manager\Moviles;

use Illuminate\Contracts\Support\Responsable;

use App\Modelos\DBGestra\ViewMoviles;

class Filtrar implements Responsable
{
    protected $_docu_empre = '96711420';
    protected $_pate_movil;

	public function __construct($request)
	{
        $this->_pate_movil = $request->pate_movil;
	}

	public function toResponse($request)
	{
        $docu_empre = $this->_docu_empre;
        $pate_movil = $this->_pate_movil;
        $listado = ViewMoviles::_filtrar($docu_empre, $pate_movil);
        
        if($listado->count() > 0){
            return response()->json([
                    'listado' => $listado->toArray(),
                    'total' => $listado->count()
            ], 200);
        } else {
            return response('No se Encontraron Conductores con este Apellido.', 404);
        }
	}
}