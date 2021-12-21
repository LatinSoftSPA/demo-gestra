<?php

namespace App\Modelos\Vistas;

use Illuminate\Database\Eloquent\Model;

class ViewListarServicios extends Model
{
	protected $connection = 'db_servicios';
	
    protected $table = 'viewListarServicios';
	protected $primaryKey = 'codi_circu';
	
	protected $fillable = [
							'codi_servi', 'codi_circu', 'inic_servi', 'term_servi',
							'docu_empre', 'docu_perso', 'nume_movil', 'pate_movil', 
							'codi_equip', 'fech_revis', 
							'iniciado', 'finalizado', 'habilitado', 'procesar', 'serv_anter',   
							'multado', 'tota_pagar', 'tota_pagad'
							,'dia'
						];

}