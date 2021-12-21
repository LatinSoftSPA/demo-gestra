<?php

namespace App\Modelos\DBServicios;

use App\Modelos\DBServicios\Configuracion;

class Pago extends Configuracion
{
	protected $table = 'tb_pagos';
	protected $primaryKey = 'codi_servi';

	protected $fillable = [
		'codi_servi', 'codi_circu', 'nume_movil',  
		'tipo_pago', 'nota_pago', 'pago_total', 'desc_total',  'user_modif',
	];

	protected $dates = [
		'created_at',
		'updated_at',
		'deleted_at'
	];

	public static function _crear($s, $c, $m, $t, $n, $p, $d, $u)
	{
		try
        {
            Pago::create([
                'codi_servi' => $s,
                'codi_circu' => $c,
                'nume_movil' => $m,

                'tipo_pago'  => $t,
                'nota_pago'  => $n,
                'pago_total' => $p,
                'desc_total' => $d,
                'user_modif' => $u
            ]);
        } catch (\Exception $e){
            return response('No se Encontro Programada...!!!', 500);
        }
	}
}
