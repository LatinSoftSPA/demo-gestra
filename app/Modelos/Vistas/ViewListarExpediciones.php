<?php

namespace App\Modelos\Vistas;

use Illuminate\Database\Eloquent\Model;

class ViewListarExpediciones extends Model
{
	protected $connection = 'db_servicios';
	
    protected $table = 'viewListarExpediciones';
	protected $primaryKey = 'codi_servi';
	
	protected $fillable = [
							'codi_servi', 'codi_senti', 'pate_movil', 'nume_movil', 
							'codi_circu', 'docu_perso', 'prim_nombr', 'segu_nombr', 
							'apel_pater', 'apel_mater', 'inic_exped', 'term_exped', 
							'iniciada', 'terminada', 'procesada', 'docu_empre', 'codi_equip' 
						];
}