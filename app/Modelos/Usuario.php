<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
	protected $connection = 'db_latinsoft';
	
	protected $table = 'tb_usuarios';
	protected $primaryKey = 'docu_perso';
	protected $relations = ['tb_personas', 'tb_empresas', 'tb_tiposusuario'];
	protected $fillable = ['idde_usuar', 'docu_perso', 'pass_usuar', 'habilitado', 'idde_tipo', 'docu_empre', 'docu_empre'];

	/*	RELACIONES	*/
	public function persona(){
		return $this->hasOne('App\Modelos\Persona');
	}

	public function empresa(){
		return $this->belongsTo('App\Modelos\Empresa');
	}

	public function tiposusuario(){
		return $this->belongsTo('App\Modelos\Tiposusuario');
	}
}