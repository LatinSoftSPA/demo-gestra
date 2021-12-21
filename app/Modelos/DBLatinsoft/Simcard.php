<?php

namespace App\Modelos\DBLatinsoft;

use App\Modelos\DBLatinsoft\Configuracion as Model;

class Simcard extends Model
{	
	protected $table = 'tb_simcards';
	protected $primaryKey = 'nume_devic';
	protected $relations = ['tb_equipos', 'tb_moviles'];
	protected $fillable = [
							'codi_equip', 'imei_equip', 'nume_devic', 'docu_empre', 'fech_revis', 'docu_perso', 'habilitado'
						];

	/*	RELACIONES	*/
	public function simcard(){
		//return $this->belongsTo('App\Modelos\Simcard');
	}

	public function movil(){
		return $this->belongsTo('App\Modelos\Movil');
	}
}
