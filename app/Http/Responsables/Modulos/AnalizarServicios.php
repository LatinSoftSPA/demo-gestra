<?php

namespace App\Http\Responsables\Modulos;

use Illuminate\Contracts\Support\Responsable;

use App\Modelos\DBServicios\Servicio;


use Carbon\Carbon;

class AnalizarServicios implements Responsable
{
    protected $_codi_circu;
    protected $_fech_servi;

    protected $_docu_empre = '11222333';

    public function __construct($request)
    {
        $this->_codi_circu = $request->codi_circu;
        $this->_fech_servi = $request->fech_servi;
    }

    public function toResponse($request)
    {
        $docu_empre = $this->_docu_empre;
        $codi_circu = $this->_codi_circu;
        $desde = $this->_desde($this->_fech_servi);
        $hasta = $this->_hasta($this->_fech_servi);

        $analizar = $this->_listarServiciosXAnalizar($docu_empre, $codi_circu, $desde, $hasta, 'ASC');
        if ($analizar->count() > 0) {
            event(new \App\Events\Servicios\Analizar($analizar));
            $listado = $this->_listarServiciosProcesar($docu_empre, $codi_circu, $desde, $hasta, 'ASC'); //TODO

            $mensaje = 'Se encontraron ' . $listado->count() . ' Servicios.';
            return response()->json([
                'servicios'   => $listado->toArray(),
                'procesar'  => true,
                'total'     => $listado->count(),
                'msg'       => $mensaje
            ], 200);
        } else {
            return response('No se Encontraron Servicios para Procesar.', 404);
        }
    }

    private function _listarServiciosXAnalizar($e, $c, $d, $h, $o)
    {
        $listado = Servicio::where('docu_empre', $e)
            ->where('codi_circu', $c)
            ->whereBetween('inic_servi', [$d, $h])
            ->where('procesar', false)
            ->orderBy('inic_servi', $o)
            ->get();

        return $listado;
    }

    private function _listarServiciosProcesar($e, $c, $d, $h, $o)
    {
        $listado = Servicio::where('codi_circu', $c)
            ->where('docu_empre', $e)
            ->whereBetween('inic_servi', [$d, $h])
            ->where('procesar', true)
            ->orderBy('inic_servi', $o)
            ->get();

        return $listado;
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
}
