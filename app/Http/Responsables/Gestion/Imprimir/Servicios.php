<?php

namespace App\Http\Responsables\Gestion\Imprimir;

use Illuminate\Contracts\Support\Responsable;

use App\Modelos\DBServicios\ViewServicios;

use App\Http\Controllers\Imprimir\ServiciosController as ImprimirServicio;

class Servicios implements Responsable
{
	protected $_codi_circu;
	protected $_codi_servi;
	protected $_docu_empre;

	public function __construct($request, $docu_empre)
	{
		$this->_codi_circu = $request->codi_circu;
		$this->_codi_servi = $request->codi_servi;
		$this->_docu_empre = $docu_empre;
	}

	public function toResponse($request)
	{
		$docu_empre = $this->_docu_empre;
		$codi_circu = $this->_codi_circu;
		$codi_servi = $this->_codi_servi;
		$this->_imprimirServicio($docu_empre, $codi_circu, $codi_servi);
	}


	public function _imprimirServicio($docu_empre, $codi_circu, $codi_servi)
	{
		$servicio = ViewServicios::_buscar($docu_empre, $codi_circu, $codi_servi);
		if ($servicio['total'] > 0) {
			$mi_servicio = $servicio;
			$tu_servicio = null;
			if ($servicio['servicio']['serv_anter'] !== null) {
				$servicio = ViewServicios::_buscar($docu_empre, $codi_circu, $servicio['servicio']['serv_anter']);
				$tu_servicio = $servicio;
			}
			$servicio_impreso = new ImprimirServicio;
			return $servicio_impreso->imprimir($mi_servicio, $tu_servicio);
		}
	}
}
