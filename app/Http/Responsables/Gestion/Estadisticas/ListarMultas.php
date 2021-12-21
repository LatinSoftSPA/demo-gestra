<?php

namespace App\Http\Responsables\Gestion\Estadisticas;

use Illuminate\Contracts\Support\Responsable;


class ListarMultas implements Responsable
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

        $desde = $this->_desde($this->_fech_consu);
        $hasta = $this->_hasta($this->_fech_consu);
        $docu_empre = $this->_docu_empre;

        $parametros = [$codi_circu, $desde, $hasta, $docu_empre];
        $consulta = $this->_laConsultaDiaria();
        $multas['diarias'] = \DB::select($consulta, $parametros);
        $consulta = $this->_laConsultaMoviles();
        $multas['moviles'] = \DB::select($consulta, $parametros);
       
        if(isset($multas)){
            return response()->json([
                //'circuito'  => $circuito[0],
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
            'DATE_FORMAT(FROM_UNIXTIME(mul.codi_servi), "%H.%i") AS HORA, '.
            'mul.nume_movil AS MOVIL, '.
            'SUM(mul.tota_multa) AS TOTAL '.
            'FROM db_servicios.tb_multas mul '.
            'WHERE '.
            'mul.codi_circu = ? '.
            'AND mul.fech_multa BETWEEN ? AND ? '.
            'GROUP BY mul.codi_servi '.
            'ORDER BY mul.codi_servi ASC';

        return $consulta;
    }

    private function _laConsultaMoviles()
    {
        $consulta = 'SELECT '.
            'mul.nume_movil AS MOVIL, '.
            'SUM(mul.tota_multa) AS TOTAL '.
            'FROM db_servicios.tb_multas mul '.
            'WHERE '.
            'mul.codi_circu = ? '.
            'AND mul.fech_multa BETWEEN ? AND ? '.
            'GROUP BY mul.nume_movil '.
            'ORDER BY mul.nume_movil ASC';

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