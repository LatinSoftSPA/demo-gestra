<?php

namespace App\Http\Responsables\Recaudaciones\Informes\Multas;
use Illuminate\Contracts\Support\Responsable;

use App\Http\Controllers\Imprimir\Recaudaciones\MultasController as ImprimirInforme;

use Carbon\Carbon;
class Imprimir implements Responsable
{
    protected $_user_modif;
    protected $_fech_desde;
    protected $_fech_hasta;

    protected $_docu_empre = '96711420';

    public function __construct($request)
    {
        $this->_user_modif = $request->user_modif;
        $this->_fech_desde = $request->fech_desde;
        $this->_fech_hasta = $request->fech_hasta;
    }

    public function toResponse($request)
    {
        $user_modif = $this->_user_modif;
        $docu_empre = $this->_docu_empre;
        $fech_desde = $this->_fech_desde;
        $fech_hasta = $this->_fech_hasta;
				
        $desde = Carbon::parse($fech_desde)->toDateTimeString();
        $hasta = Carbon::parse($fech_hasta)->addDays(1)->toDateTimeString();
		
        $parametros = [$user_modif, $desde, $hasta];
        $consulta = $this->_consultaMultas();
        $multas = \DB::select($consulta, $parametros);
		
		
        $parametros = [$docu_empre, $user_modif];
        $consulta = $this->_consultaRecaudador();
        $recaudador = \DB::select($consulta, $parametros);
		$this->_imprimirInforme($multas[0], $recaudador[0], $fech_desde);
    }
        
    private function _consultaMultas()
    {
        $consulta = 'SELECT '.
            'pag.user_modif, '.
            'SUM(pag.pago_total) AS COBRADO, '.
            'SUM(pag.desc_total) AS DESCONTADO '.
            'FROM db_servicios.tb_pagos pag '.
            'WHERE '.
            'pag.user_modif = ? '.
            'AND pag.created_at BETWEEN ? AND ? ';

        return $consulta;
    }

    private function _consultaRecaudador()
    {
        $consulta = 'SELECT '.
            'usu.docu_empre, usu.docu_perso, usu.rol, '.
            'CONCAT_WS(" ", usu.prim_nombr, usu.apel_pater, usu.apel_mater) AS RECAUDADOR '.
            'FROM db_latinsoft.users usu '.
            'WHERE '.
            'usu.docu_empre = ? '.
            'AND usu.docu_perso = ? '.
			'LIMIT 1';

        return $consulta;
    }
    
    private function _imprimirInforme($multas, $recaudador, $fech_desde)
    {
        $informe_impreso = new ImprimirInforme;
        return $informe_impreso->imprimir($multas, $recaudador, $fech_desde);
    }
}