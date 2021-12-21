<?php
namespace App\Http\Controllers\Recaudaciones;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Responsables\Recaudaciones\Estadisticas\Multas\Listar;
use App\Http\Responsables\Recaudaciones\Informes\Multas\Imprimir;

class MultasController extends Controller
{
    public function listar(Request $request)
    {
        return new Listar($request);
    }
	
    public function imprimir(Request $request)
    {
        return new Imprimir($request);
    }
}