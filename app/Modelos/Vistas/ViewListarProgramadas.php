<?php

namespace App\Modelos\Vistas;

use Illuminate\Database\Eloquent\Model;

class ViewListarProgramadas extends Model
{
	protected $connection = 'db_servicios';
	
    protected $table = 'viewListarProgramadas';
	protected $primaryKey = 'codi_servi';

	protected $fillable = [
							'idde_progr', 'codi_servi', 'nume_movil', 'codi_circu', 'codi_ruta', 'codi_senti', 
							'codi_geoce', 'nomb_geoce', 'abre_geoce', 'fech_progr', 'fech_contr', 'grad_angul', 
							'velo_contr', 'multado', 
							'minu_toler', 'dife_contro', 'procesado', 'angulo'
						];
}