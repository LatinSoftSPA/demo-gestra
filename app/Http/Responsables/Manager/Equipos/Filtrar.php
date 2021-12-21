<?php

namespace App\Http\Responsables\Manager\Equipos;

use Illuminate\Contracts\Support\Responsable;

use App\Modelos\DBGts\ViewDevices;

class Filtrar implements Responsable
{
    protected $_accountID = 'lineas-anf';
    protected $_groupID = 'linea-104-anf';
    protected $_imeiNumber;

	public function __construct($request)
	{
        $this->_imeiNumber = $request->nume_imei;
	}

	public function toResponse($request)
	{
        $accountID = $this->_accountID;
        $groupID = $this->_groupID;
        $imeiNumber = $this->_imeiNumber;

        $listado = ViewDevices::_filtrar($accountID, $groupID, $imeiNumber);
        
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