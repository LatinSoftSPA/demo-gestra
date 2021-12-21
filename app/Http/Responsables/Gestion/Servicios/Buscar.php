<?php

namespace App\Http\Responsables\Gestion\Servicios;

use Illuminate\Contracts\Support\Responsable;

use App\Modelos\DBServicios\ViewServicios;


class Buscar implements Responsable
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

		$servicio = ViewServicios::_buscar($docu_empre, $codi_circu, $codi_servi);
		if ($servicio['total'] > 0) {
			$mi_servicio = $servicio;
			$tu_servicio = null;
			if ($servicio['servicio']['serv_anter'] !== null) {
				$servicio = ViewServicios::_buscar($docu_empre, $codi_circu, $servicio['servicio']['serv_anter']);
				$tu_servicio = $servicio;
			}
			$el_objeto['mi_servicio'] = $mi_servicio;
			$el_objeto['tu_servicio'] = $tu_servicio;

			return response($el_objeto, 200);
		} else {
			return response('No se Encontro el Servicio Seleccionado.', 404);
		}
	}
}
