<?php

namespace App\Modelos\Vistas;

use Illuminate\Database\Eloquent\Model;

class ViewListarEmpresas extends Model
{
	protected $connection = 'db_latinsoft';

	protected $table = 'tb_empresas';
	protected $primaryKey = 'docu_empre';
	//protected $relations = ['tb_usuarios'];

	protected $fillable = [
							'docu_empre', 'nomb_empre', 'domi_empre', 'tele_movil', 'mail_empre', 'habilitado', 'idde_unego' 
						];

	public function scopeSearch($query, $docu_empre){
		return $query->where('docu_empre', 'LIKE', "%$docu_empre%");
	}
}