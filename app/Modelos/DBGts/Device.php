<?php

namespace App\Modelos\DBGts;

use App\Modelos\DBGts\Configuracion as Model;

class Device extends Model
{
	protected $table = 'Device';

	protected $fillable = 
	[
		'displayName', 'description', 'imeiNumber', 'accountID', 'deviceID', 'groupID', 'equipmentStatus', 
		'vehicleYear', 'vehicleID', 'licensePlate', 'driverID', 'uniqueID', 'serialNumber', 'simPhoneNumber', 
		'ignitionIndex', 'lastTotalConnectTime', 'lastGPSTimestamp', 'lastValidLatitude', 'lastValidLongitude', 
		'lastIgnitionOnTime', 'lastIgnitionHours', 'isActive' 
	];

    public static function _buscar($accountID, $groupID, $imeiNumber, $deviceID)
    {
        try
        {
            $listado = Device::where('deviceID', $deviceID)
                ->where('accountID', $accountID)
                ->where('groupID', $groupID)
                ->where('imeiNumber', $imeiNumber)
                ->get();

            return $listado; 
        } catch (\Exception $e){
            return response('Algo salio mal...!!!', 500);
        }
    }
}