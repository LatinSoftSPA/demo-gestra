<?php

namespace App\Http\Responsables\Gestion\Estadisticas;

use Illuminate\Contracts\Support\Responsable;

class ListarExpediciones implements Responsable
{
    protected $_codi_circu;
    protected $_fech_consu;
    protected $_codi_dia;
    protected $_docu_empre = '96711420';

    public function __construct($request)
    {
        $this->_codi_circu = $request->codi_circu;
        $this->_fech_consu = $request->fech_consu;
    }

    public function toResponse($request)
    {
        $codi_circu = $this->_codi_circu;

        $codi_senti = $this->_codigoSentido('');
        $desde = $this->_desde($this->_fech_consu);
        $hasta = $this->_hasta($this->_fech_consu);
        $codi_dia = $this->_codigoDia($this->_fech_consu);
        $docu_empre = $this->_docu_empre;


        //$parametros = [$codi_circu, $codi_senti, $desde, $hasta, $codi_dia, $docu_empre];
        $parametros = [$codi_circu, 0, $desde, $hasta, $codi_dia, $docu_empre];
        $consulta = $this->_laConsulta();
        $expediciones['ida'] = \DB::select($consulta, $parametros);
        $parametros = [$codi_circu, 1, $desde, $hasta, $codi_dia, $docu_empre];
        $consulta = $this->_laConsulta();
        $expediciones['reg'] = \DB::select($consulta, $parametros);

       
        if(isset($expediciones)){
            return response()->json([
                'expediciones'   => $expediciones,
                'status'    => 'ok',

            ], 200);
        } else {
            return response('No se Encontraron Expediciones para el "Dia" Seleccionado.', 404);
        }
    }

    private function _laConsulta()
    {
        $consulta = 'SELECT '.
            'HOUR(exp.inic_exped) AS PERIODO, '.
            //'pla.desc_perio, '.
            'pla.exigidos AS EXIGIDO, COUNT(exp.inic_exped) AS REGISTRADO '.
            //'exp.codi_circu, exp.codi_senti '.
            'FROM db_servicios.tb_expediciones exp '.
            'INNER JOIN db_gestra.tb_plan_operacional pla ON exp.codi_senti = pla.codi_senti '.
            'WHERE '.
            'exp.codi_circu = ? '.
            'AND exp.codi_senti = ? '.
            'AND exp.inic_exped BETWEEN ? AND ? '.
            'AND pla.codi_dia = ? '.
            'AND pla.docu_empre = ? '.
            'AND pla.habilitado = TRUE '.
            'AND HOUR(exp.inic_exped) = pla.codi_perio '.
            'AND pla.codi_circu = exp.codi_circu '.
            'GROUP BY PERIODO '.
            'ORDER BY exp.inic_exped ASC';

        return $consulta;
    }

    private function _desde($fecha)
    {
        $desde = strtotime('+0 day', strtotime($fecha));
        $desde = date('Y-m-d H:i:s', $desde);
        return $desde;
    }

    private function _hasta($fecha)
    {
        $hasta = strtotime('+1 day', strtotime($fecha));
        $hasta = date('Y-m-d H:i:s', $hasta);
        return $hasta;
    }

    private function _codigoSentido($tipo_circu)
    {
        //TODO
        return 0;
    }

    private function _codigoDia($fech_consu)
    {
        //TODO
        return 0;
    }
}