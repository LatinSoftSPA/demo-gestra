<?php

namespace App\Modelos\DBLatinsoft;

use App\Modelos\DBLatinsoft\Configuracion as Model;

class ECivil extends Model
{
	protected $table = 'tb_estadosciviles';
	protected $primaryKey = 'idde_ecivi	';
	
	protected $fillable = [
		'idde_ecivi	', 'nomb_ecivi', 'abre_ecivi'
	];

	public static function _listar()
    {
        try
        {
            $listado = ECivil::orderBy('nomb_ecivi', 'ASC')
                ->pluck('nomb_ecivi', 'idde_ecivi')
                ->all();

            return $listado; 
        } catch (\Exception $e){
            return response('Algo salio mal...!!!', 500);
        }
    }
}