<?php

namespace App\Http\Controllers\Gestion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Responsables\Gestion\Estadisticas\Home;

use App\Http\Responsables\Gestion\Estadisticas\ListarExpediciones;
use App\Http\Responsables\Gestion\Estadisticas\ListarServicios;
use App\Http\Responsables\Gestion\Estadisticas\ListarMultas;

class EstadisticasController extends Controller
{
    public function index(Request $request)
    {
        return new Home($request);
    }

    public function listarExpediciones(Request $request)
    {
        return new ListarExpediciones($request);
    }

    public function listarServicios(Request $request)
    {
        return new ListarServicios($request);
    }

    public function listarMultas(Request $request)
    {
        return new ListarMultas($request);
    }
}