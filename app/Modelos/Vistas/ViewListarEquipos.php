<?php

namespace App\Modelos\Vistas;

use Illuminate\Database\Eloquent\Model;

class ViewListarEquipos extends Model
{
	protected $connection = 'db_latinsoft';
	
    protected $table = 'viewListarEquipos';
	protected $primaryKey = 'nume_movil';
	
	protected $fillable = [
							'codi_equip', 'imei_equip', 'habilitado', 
							'docu_perso', 'prim_nombr', 'segu_nombr', 'apel_pater', 'apel_mater', 
							'idde_simca', 'nume_telef', 'nume_serie', 
							'idde_opera', 'nomb_opera' 
						];
}