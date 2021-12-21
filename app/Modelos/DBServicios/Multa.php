<?php

namespace App\Modelos\DBServicios;

use App\Modelos\DBServicios\Configuracion;

class Multa extends Configuracion
{
	protected $table = 'tb_multas';
	protected $primaryKey = 'codi_servi';

	protected $fillable = [
		'codi_servi', 'codi_circu', 'nume_movil', 'codi_senti',   
		'tota_multa', 'fech_multa', 'tota_pagad', 'fech_pagad', 
		'pagada', 'user_modif'
	];

	protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public static function _crear($obj)
	{
        try
        {
            Multa::create($obj);
        } catch (\Exception $e){
            return response('Problemas al tratar de Crear: Multa', 500);
        }
	}

    public static function definirMulta($codi_servi, $codi_circu, $nume_movil, $codi_senti, $tota_multa, $fech_multa, $user_modif)
    {
        $multa['codi_servi'] = $codi_servi;
        $multa['codi_circu'] = $codi_circu;
        $multa['nume_movil'] = $nume_movil;
        $multa['codi_senti'] = $codi_senti;
        $multa['tota_multa'] = $tota_multa;
        $multa['fech_multa'] = $fech_multa;
        $multa['user_modif'] = $user_modif;

        $this->_crear($multa);
    }
}
