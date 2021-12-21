<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Responsables\Manager\Equipos\Home;

use App\Http\Responsables\Manager\Equipos\Actualizar;
use App\Http\Responsables\Manager\Equipos\Buscar;
//use App\Http\Responsables\Manager\Equipos\Eliminar;
use App\Http\Responsables\Manager\Equipos\Filtrar;
use App\Http\Responsables\Manager\Equipos\Guardar;
use App\Http\Responsables\Manager\Equipos\Listar;

class EquiposController extends Controller
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

    //public function eliminar(Request $request)
    //{
    //    return new Eliminar($request);
    //}

    public function filtrar(Request $request)
    {    
        return new Filtrar($request);
    }

    public function guardar(Request $request)
    {
        
        return $request->toArray();
    }

    public function listar(Request $request)
    {
        return new Listar($request);
    }

}
