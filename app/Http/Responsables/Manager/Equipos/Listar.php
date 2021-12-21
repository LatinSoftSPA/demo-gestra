<?php

namespace App\Http\Responsables\Manager\Equipos;

use Illuminate\Contracts\Support\Responsable;

use App\Modelos\DBGts\ViewDevices;

class Listar implements Responsable
{
    protected $_accountID = 'lineas-anf';
    protected $_groupID = 'linea-104-anf';

	public function __construct($request)
	{
	}

	public function toResponse($request)
	{
        $accountID = $this->_accountID;
        $groupID = $this->_groupID;

        $listado = ViewDevices::_listar($accountID, $groupID);
        
        if($listado->count() > 0){
            return response()->json([
                    'listado' => $listado->toArray(),
                    'total' => $listado->count()
            ], 200);
        } else {
            return response('No se Encontraron Equipos para esta empresa.', 404);
        }
	}
}