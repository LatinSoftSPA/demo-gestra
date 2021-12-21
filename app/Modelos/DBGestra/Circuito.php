<?php

namespace App\Modelos\DBGestra;

use App\Modelos\DBGestra\Configuracion as Model;

class Circuito extends Model
{
	protected $table = 'tb_circuitos';
	protected $primaryKey = 'docu_empre';
	protected $relations = ['db_servicios'];
	protected $fillable = [
		'docu_empre', 'codi_circu', 'nomb_circu', 'abre_circu', 'unid_negoc'
	];

	/*	RELACIONES	*/
	public function servicios(){
		return $this->hasMany('App\Modelos\Servicio');
	}




	public static function buscar($codi_circu, $docu_empre)
	{
		return Circuito::where('codi_circu', $codi_circu)
            ->where('docu_empre', $docu_empre)
            ->limit(1)
            ->get();
	}
}