<?php

namespace App\Http\Responsables\Modulos;

use Illuminate\Contracts\Support\Responsable;

use App\Modelos\DBServicios\ViewServicios;

class IniciarServicios implements Responsable
{
	protected $_codi_circu;
	protected $_fech_servi;

	protected $_docu_empre = '96711420';

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

        $lst = $this->_listarServiciosIniciando($docu_empre, $codi_circu, $desde, $hasta, 'DESC');

        if($lst->count() > 0){
            $mensaje = 'Se encontraron ' .$lst->count(). ' Servicios.';
            return response()->json([
                    'listado'   => $lst->toArray(),
                    'procesar'  => true, 
                    'total'     => $lst->count(),
                    'msg'       => $mensaje
            ], 200);
        } else {
            return response('No se Encontraron Servicios para el "Dia" Seleccionado.', 404);
        }
	}

	private function _listarServiciosIniciando($e, $c, $d, $h, $o)
	{
		$listado = ViewServicios::where('codi_circu', $c)
            ->where('docu_empre', $e)
            ->whereBetween('inic_servi', [$d, $h])
            ->where('iniciado', false)
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