<?php

namespace App\Modelos\Vistas;

use Illuminate\Database\Eloquent\Model;

class ViewListarGeozonas extends Model
{
	protected $connection = 'db_gts';
	
    protected $table = 'viewListarGeozonas';
	protected $primaryKey = 'geozoneID';
	
	protected $fillable = [
							'geozoneID', 'description', 'displayName', 'arrivalZone', 'departureZone', 
							'latitude1', 'longitude1', 'latitude2', 'longitude2', 'latitude3', 'longitude3', 
							'latitude4', 'longitude4', 'latitude5', 'longitude5', 'latitude6', 'longitude6', 
							'latitude7', 'longitude7', 'latitude8', 'longitude8', 'latitude9', 'longitude9', 
							'latitude10', 'longitude10', 'isActive' 
						];

	/*
	public function scopeSearch($query, $nomb_geozo){
		return $query->where('description', 'LIKE', "%$nomb_geozo%");
	}
	*/
}