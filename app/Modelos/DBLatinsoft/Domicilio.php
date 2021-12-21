<?php

namespace App\Modelos\DBLatinsoft;

use App\Modelos\DBLatinsoft\Configuracion as Model;

class Domicilio extends Model
{	
	protected $table = 'tb_domicilios';
	protected $primaryKey = 'docu_perso';
	protected $relations = ['tb_personas', 'tb_ciudades'];
	protected $fillable = ['docu_perso', 'nomb_domic', 'nume_domic', 'nomb_pobla', 'nume_bloqu', 'nume_depto', 'idde_provi', 'idde_comun'];

	public static function _buscar($docu_perso)
	{
		$domicilio = Domicilio::where('docu_perso', $docu_perso)->get();
		return $domicilio;
	}

	/*	RELACIONES	*/
	public function persona(){
		return $this->belongsTo('App\Modelos\Persona');
	}

	public function ciudad(){
		return $this->belongsTo('App\Modelos\Ciudad');
	}
}