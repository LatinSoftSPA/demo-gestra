<?php

namespace App\Modelos\Vistas;

use Illuminate\Database\Eloquent\Model;

class ViewListarArribos extends Model
{
	protected $connection = 'db_gts';
	
    protected $table = 'viewListarArribos';
	protected $primaryKey = 'deviceID';
	
	protected $fillable = [
		'timestamp', 'latitude', 'longitude', 'speedKPH', 'heading', 'odometerKM', 
		'geozoneID', 'address', 'ignitionState', 'deviceID', 'accountID' 
	];
}