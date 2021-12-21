<?php

namespace App\Modelos\DBServicios;

use App\Modelos\DBServicios\Configuracion as Model;

class Periodo extends Model
{
	protected $table = 'tb_periodos';
	protected $primaryKey = 'codi_perio';
	protected $fillable = [
		'codi_perio', 'desc_perio', 'docu_empre', 'habilitado'
	];

	protected $dates = [
        'created_at',
        'updated_at'
    ];

	public static function _listar($docu_empre)
    {
    	try
        {
            $listado = Periodo::where('docu_empre', $docu_empre)
                ->orderBy('codi_perio')
                ->get();

            return $listado; 
        } catch (\Exception $e){
            return response('Algo salio mal...!!!', 500);
        }
	}
}