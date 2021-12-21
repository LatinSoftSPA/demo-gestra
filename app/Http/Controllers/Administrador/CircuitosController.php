<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Responsables\Administrar\Circuitos\Home;
use App\Http\Responsables\Administrar\Circuitos\Listar;
use App\Http\Responsables\Administrar\Circuitos\Filtrar;

class CircuitosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {        
        return new Home($request);
    }

    public function listar(Request $request)
    {        
        return new Listar($request);
    }

    public function filtrar(Request $request)
    {        
        return new Filtrar($request);
    }
}