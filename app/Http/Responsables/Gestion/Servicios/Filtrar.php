<?php

namespace App\Http\Responsables\Gestion\Servicios;

use Illuminate\Contracts\Support\Responsable;

use App\Modelos\DBServicios\ViewServicios;

class Filtrar implements Responsable
{
	protected $_codi_circu;
	protected $_fech_servi;
	protected $_nume_movil;

	protected $_docu_empre;

	public function __construct($request, $docu_empre)
	{
		$this->_codi_circu = $request->codi_circu;
		$this->_fech_servi = $request->fech_servi;
		$this->_nume_movil = $request->nume_movil;
		$this->_docu_empre = $docu_empre;
	}

	public function toResponse($request)
	{
		$docu_empre = $this->_docu_empre;
		$codi_circu = $this->_codi_circu;
		$desde = $this->_desde($this->_fech_servi);
		$hasta = $this->_hasta($this->_fech_servi);
		$nume_movil = $this->_nume_movil;

		$lst = ViewServicios::_filtrar($docu_empre, $codi_circu, $desde, $hasta, $nume_movil, 'ASC');
		if ($lst->count() > 0) {
			$mensaje = 'Se encontraron ' . $lst->count() . ' Servicios.';
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
