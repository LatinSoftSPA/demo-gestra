<?php

namespace App\Modelos\DBLatinsoft;

use App\Modelos\DBLatinsoft\Configuracion as Model;

class Ciudad extends Model
{
	protected $table = 'tb_ciudades';
	protected $primaryKey = 'idde_ciuda';
	protected $relations = ['tb_domicilios', 'tb_provincias'];
	protected $fillable = ['idde_ciuda', 'idde_provi', 'nomb_ciuda', 'abre_ciuda'];

	/*	RELACIONES	*/
	public function domicilio(){
		return $this->belongsTo('App\Modelos\Domicilio');
	}

	public function provincia(){
		return $this->belongsTo('App\Modelos\Provincia');
	}
}