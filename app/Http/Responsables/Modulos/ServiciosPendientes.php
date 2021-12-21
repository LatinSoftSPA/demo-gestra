<?php

namespace App\Http\Responsables\Modulos;

use Illuminate\Contracts\Support\Responsable;

use App\Modelos\DBGestra\Servicio;

class ServiciosPendientes implements Responsable
{
    protected $_codi_circu;
    protected $_fech_servi;
    protected $_nume_movil;

    protected $_docu_empre = '96711420';

    public function __construct($request)
    {
        $this->_codi_circu = $request->codi_circu;
        $this->_fech_servi = $request->fech_servi;
        $this->_nume_movil = $request->nume_movil;
    }

    public function toResponse($request)
    {
        $docu_empre = $this->_docu_empre;
        $codi_circu = $this->_codi_circu;
        $nume_movil = $this->_nume_movil;
        $desde = $this->_desde($this->_fech_servi);
        $hasta = $this->_hasta($this->_fech_servi);

        $pendientes = Servicio::where('docu_empre', $docu_empre)
                ->where('codi_circu', $codi_circu)
                ->whereBetween('inic_servi', [$desde, $hasta])
                ->where('nume_movil', $nume_movil)
                ->where('finalizado', false)
                ->get();

        if($pendientes->count() > 0){
            return response()->json([
                'pendientes' => $pendientes[0]->toArray(), 
                'total'     => $pendientes->count()
            ], 200);
        } else {
            return response('No se Encontro Servicios Pendientes', 404);
        }
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