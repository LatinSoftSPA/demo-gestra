<?php

namespace App\Modelos\Vistas;

use Illuminate\Database\Eloquent\Model;

class ViewListarRutas extends Model
{
	protected $connection = 'db_servicios';
	
    protected $table = 'viewListarRutas';
	protected $primaryKey = 'codi_ruta';
	
	protected $fillable = [
		'codi_ruta', 'codi_circu', 'docu_empre', 
		'nomb_ruta', 'abre_ruta', 'codi_senti' 
	];
}