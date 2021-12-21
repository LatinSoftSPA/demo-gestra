<?php

namespace App\Http\Responsables\Recaudaciones\Estadisticas\Multas;

use Illuminate\Contracts\Support\Responsable;

use Carbon\Carbon;
class Listar implements Responsable
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
        $fech_desde = $this->_fech_desde;
        $fech_hasta = $this->_fech_hasta;
		
        $desde = Carbon::parse($fech_desde)->toDateTimeString();
        $hasta = Carbon::parse($fech_hasta)->addDays(1)->toDateTimeString();               
        
        $parametros = [$user_modif, $desde, $hasta];
        $consulta = $this->_laConsultaDiaria();
        $multas = \DB::select($consulta, $parametros);

        
        if(isset($multas)){
            return response()->json([
                'multas'   => $multas,
                'status'    => 'ok',

            ], 200);
        } else {
            return response('No se Encontraron Multas para el "Dia" Seleccionado.', 404);
        }
    }
    
    private function _laConsultaDiaria()
    {
        $consulta = 'SELECT '.
            'pag.nume_movil AS MOVIL, '.
            'DATE_FORMAT(FROM_UNIXTIME(pag.codi_servi), "%H:%i") AS HORA, '.
            '(pag.pago_total + pag.desc_total) AS TOTAL, '.
            'pag.pago_total AS COBRADO, '.
            'pag.desc_total AS DESCUENTO '.
            'FROM db_servicios.tb_pagos pag '.
            'WHERE '.
            'pag.user_modif = ? '.
            'AND pag.created_at BETWEEN ? AND ? '.
            'ORDER BY pag.codi_servi ASC';

        return $consulta;
    }
}