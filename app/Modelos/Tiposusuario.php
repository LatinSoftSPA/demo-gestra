<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Tiposusuario extends Model
{
	protected $connection = 'db_latinsoft';
	
	protected $table = 'tb_tiposusuario';
	protected $primaryKey = 'idde_tipo';
	protected $relations = ['tb_usuarios'];
	protected $fillable = ['idde_tipo', 'nomb_tipo', 'abre_tipo'];

	/*	RELACIONES	*/
	public function usuario(){
		return $this->belongsTo('App\Modelos\Usuario');
	}
}