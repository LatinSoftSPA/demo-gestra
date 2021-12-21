<?php

namespace App\Modelos\Vistas;

use Illuminate\Database\Eloquent\Model;

class ViewListarDevices extends Model
{
	protected $connection = 'db_gts';

	protected $table = 'Device';
	protected $primaryKey = 'deviceID';
	//protected $relations = ['tb_usuarios'];

	protected $fillable = 
	[
		'displayName', 'description', 'imeiNumber', 'accountID', 'deviceID', 'groupID', 'equipmentStatus', 
		'vehicleYear', 'vehicleID', 'licensePlate', 'driverID', 'uniqueID', 'serialNumber', 'simPhoneNumber', 
		'ignitionIndex', 'lastTotalConnectTime', 'lastGPSTimestamp', 'lastValidLatitude', 'lastValidLongitude', 
		'lastIgnitionOnTime', 'lastIgnitionHours', 'isActive' 
	];
}