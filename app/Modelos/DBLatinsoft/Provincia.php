<?php

namespace App\Modelos\DBLatinsoft;

use App\Modelos\DBLatinsoft\Configuracion as Model;

class Provincia extends Model
{
	protected $connection = 'db_latinsoft';
	
	protected $table = 'tb_provincias';
	protected $primaryKey = 'idde_provi';
	protected $relations = ['tb_comunas'];
	protected $fillable = ['idde_ciuda', 'nomb_provi', 'abre_provi', 'idde_pais'];

	public static function _listar()
    {
        try
        {
            $listado = Provincia::orderBy('nomb_provi', 'ASC')
                ->pluck('nomb_provi', 'idde_provi')
                ->all();

            return $listado; 
        } catch (\Exception $e){
            return response('Algo salio mal...!!!', 500);
        }
    }
}