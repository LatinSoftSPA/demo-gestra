<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Responsables\Manager\Conductores\Home;

use App\Http\Responsables\Manager\Conductores\Actualizar;
use App\Http\Responsables\Manager\Conductores\Buscar;
use App\Http\Responsables\Manager\Conductores\Eliminar;
use App\Http\Responsables\Manager\Conductores\Filtrar;
use App\Http\Responsables\Manager\Conductores\Guardar;
use App\Http\Responsables\Manager\Conductores\Listar;

class ConductoresController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->_docu_empre = 11222333;
    }

    public function index(Request $request)
    {
        return new Home($request);
    }

    public function actualizar(Request $request)
    {
        return new Actualizar($request);
    }

    public function buscar(Request $request)
    {
        return new Buscar($request);
    }

    public function eliminar(Request $request)
    {
        return new Eliminar($request);
    }

    public function filtrar(Request $request)
    {
        return new Filtrar($request);
    }

    public function guardar(Request $request)
    {
        return new Guardar($request, $this->_docu_empre);
    }

    public function listar(Request $request)
    {
        return new Listar($request);
    }
}
