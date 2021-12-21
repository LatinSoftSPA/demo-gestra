<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Responsables\Manager\Servicios\Home;

use App\Http\Responsables\Manager\Servicios\Listar;

use App\Http\Controllers\Imprimir\ServiciosController as ImprimirServicio;

class ServiciosController extends Controller
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
}