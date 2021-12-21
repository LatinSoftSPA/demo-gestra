<?php

namespace App\Http\Responsables\Manager\Propietarios;

use Illuminate\Contracts\Support\Responsable;

use App\Modelos\DBGestra\ViewPropietarios;

class Listar implements Responsable
{
	protected $_docu_empre = '96711420';

	public function __construct($request)
	{
	}

	public function toResponse($request)
	{
        $docu_empre = $this->_docu_empre;              
        $listado = ViewPropietarios::_listar($docu_empre);//TODO: CHECK
        
        if($listado->count() > 0){
            return response()->json([
                    'listado' => $listado->toArray(),
                    'total' => $listado->count()
            ], 200);
        } else {
            return response('No se Encontraron Conductores para esta empresa.', 404);
        }
	}
}