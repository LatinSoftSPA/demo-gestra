<?php

namespace App\Modelos\DBLatinsoft;

use App\Modelos\DBLatinsoft\Configuracion as Model;

class Empresa extends Model
{
	protected $table = 'tb_empresas';
	protected $primaryKey = 'docu_empre';

	protected $fillable = [
		'docu_empre', 'nomb_empre', 'domi_empre', 'tele_movil', 'mail_empre', 'habilitada', 'idde_unego' 
	];
}