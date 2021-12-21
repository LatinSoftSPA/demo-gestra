<?php

namespace App\Http\Responsables\Manager\Equipos;

use Illuminate\Contracts\Support\Responsable;

use App\Modelos\DBGts\Device;

class Buscar implements Responsable
{
    protected $_accountID = 'lineas-anf';
    protected $_groupID = 'linea-104-anf';
    protected $_imeiNumber;
    protected $_deviceID;

	public function __construct($request)
	{
        $this->_imeiNumber = $request->imeiNumber;
        $this->_deviceID = $request->deviceID;
	}

	public function toResponse($request)
	{
        $accountID = $this->_accountID;
        $groupID = $this->_groupID;
        $imeiNumber = $this->_imeiNumber;
        $deviceID = $this->_deviceID;

        $objeto = Device::_buscar($accountID, $groupID, $imeiNumber, $deviceID);
        return $objeto;
	}
}