<?php

namespace App\Http\Controllers\Informes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Responsables\Informes\Servicios\Home;

use App\Http\Responsables\Informes\Servicios\Listar;

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