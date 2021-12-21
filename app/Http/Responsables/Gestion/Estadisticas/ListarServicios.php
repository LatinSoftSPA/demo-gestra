<?php

namespace App\Http\Responsables\Gestion\Estadisticas;

use Illuminate\Contracts\Support\Responsable;

use App\Modelos\DBGestra\Circuito;

class ListarServicios implements Responsable
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
        $circuito = Circuito::where('codi_circu', $codi_circu)->get();
        //return $circuito[0]->tipo_circu;

        $desde = $this->_desde($this->_fech_consu);
        $hasta = $this->_hasta($this->_fech_consu);
        $docu_empre = $this->_docu_empre;
        
        $parametros = [$codi_circu, $desde, $hasta, $docu_empre];
        $consulta = $this->_laConsulta();
        $servicios = \DB::select($consulta, $parametros);
       
        if(isset($servicios)){
            return response()->json([
                'circuito'  => $circuito[0],
                'servicios'   => $servicios,
                'status'    => 'ok',

            ], 200);
        } else {
            return response('No se Encontraron Expediciones para el "Dia" Seleccionado.', 404);
        }
    }

    private function _laConsulta()
    {
        $consulta = 'SELECT '.
            'ser.nume_movil AS MOVIL, '.
            'COUNT(ser.inic_servi) AS TOTAL '.
            'FROM db_servicios.tb_servicios ser '.
            'WHERE '.
            'ser.codi_circu = ? '.
            'AND ser.inic_servi BETWEEN ? AND ? '.
            'AND ser.docu_empre = ? '.
            'GROUP BY ser.nume_movil '.
            'ORDER BY ser.nume_movil ASC';

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