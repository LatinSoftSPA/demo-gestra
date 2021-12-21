<?php

namespace App\Modelos\DBLatinsoft;

use App\Modelos\DBLatinsoft\Configuracion as Model;

class Contacto extends Model
{
	protected $table = 'tb_contactos';
	protected $primaryKey = 'docu_perso';
	protected $relations = ['tb_personas'];
	protected $fillable = ['idde_conta', 'docu_perso', 'tele_conta', 'movi_conta', 'mail_conta'];

	public static function _buscar($docu_perso)
	{
		$contacto = Contacto::where('docu_perso', $docu_perso)->get();
		return $contacto;
	}
	/*	RELACIONES	*/
	public function persona(){
		return $this->belongsTo('App\Modelos\Persona');
	}
}