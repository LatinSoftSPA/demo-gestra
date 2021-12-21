<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Responsables\Manager\Propietarios\Home;

use App\Http\Responsables\Manager\Propietarios\Actualizar;
use App\Http\Responsables\Manager\Propietarios\Buscar;
use App\Http\Responsables\Manager\Propietarios\Eliminar;
use App\Http\Responsables\Manager\Propietarios\Filtrar;
use App\Http\Responsables\Manager\Propietarios\Guardar;
use App\Http\Responsables\Manager\Propietarios\Listar;

class PropietariosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
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
        return new Guardar($request);
    }
    
    public function listar(Request $request)
    {
        return new Listar($request);
    }
    
}
