<?php

namespace App\Http\Controllers\Monitores;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Responsables\Monitores\FrecuenciaServicios;
use App\Modelos\DBServicios\ViewServicios;
class FrecuenciaController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }

	public function index(Request $request)
    {
        return new FrecuenciaServicios($request);
    }

    public function listarServicios(Request $request)
    {
    	return $this->_listarServicios($request);
    }

    private function _listarServicios(Request $request)
    {
        $docu_empre = $request->docu_empre;
        $codi_circu = $request->codi_circu;
        $fech_servi = $request->fech_servi;

        $desde = strtotime(date('Y-m-d 00:00:00'));
        $hasta = strtotime(date('Y-m-d 23:59:59'));

        return ViewServicios::where('codi_circu', $codi_circu)
                    ->where('docu_empre', $docu_empre)
                    ->whereBetween('codi_servi', [$desde, $hasta])
                    ->limit(14)
                    ->get();
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