<?php

namespace App\Modelos\Vistas;

use Illuminate\Database\Eloquent\Model;

class ViewListarPuntosControl extends Model
{
	protected $connection = 'db_servicios';
	
    protected $table = 'viewListarPuntosControl';
	protected $primaryKey = 'codi_circu';
	
	protected $fillable = [
							'codi_circu', 'codi_senti', 'codi_ruta', 'codi_geoce', 'nomb_geoce', 
							'minu_contr', 'minu_toler', 'tipo_contr', 'visible', 'posi_contr', 
							'abre_geoce', 'nomb_ruta', 'abre_ruta', 'docu_empre' 
						];

	public function scopeSearch($query, $codi_circu){
		return $query
				->where('codi_circu', '=' , $codi_circu);
	}
}