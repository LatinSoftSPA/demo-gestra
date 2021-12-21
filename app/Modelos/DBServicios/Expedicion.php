<?php

namespace App\Modelos\DBServicios;

use App\Modelos\DBServicios\Configuracion as Model;

class Expedicion extends Model
{
	protected $table = 'tb_expediciones';
	protected $primaryKey = 'codi_servi';
	protected $relations = ['tb_servicios'];
	protected $fillable = [
							'codi_servi', 'codi_circu', 'codi_senti', 'pate_movil', 'nume_movil', 
							'docu_empre', 'docu_perso', 'inic_exped', 'term_exped', 
							'iniciada', 'terminada', 'procesada'
						];
						
	protected $dates = [
		'created_at',
		'updated_at',
		'deleted_at'
	];	

	public static function _crear($expedicion)
    {
		try
		{
			$obj = new Expedicion($expedicion);
			Expedicion::create($obj->toArray());
		} catch (\Exception $e){
			\DB::rollback();
			return response('Algo salio mal al Crear Las Expediciones...!!!', 500);
		}
	}
}