<?php

namespace App\Modelos\DBServicios;

use App\Modelos\DBServicios\Configuracion as Model;

class Ruta extends Model
{
	protected $table = 'tb_rutas';
	protected $primaryKey = 'codi_ruta';
	//protected $relations = ['', '', ''];
	protected $fillable = [
		'codi_ruta', 'codi_circu', 'nomb_ruta', 'abre_ruta', 'codi_senti'
	];

	/*	RELACIONES	*/
	public function propietario(){
		return $this->belongsTo('App\Modelos\Propietario');
	}



	public static function buscar($codi_circu, $docu_empre)
	{
		return Ruta::where('codi_circu', $codi_circu)
            ->where('docu_empre', $docu_empre)
            ->get();
	}
}
