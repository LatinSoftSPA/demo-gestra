<?php

namespace App\Http\Controllers\Informes;
use App\Http\Responsables\Informes\Propietarios\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PropietariosController extends Controller
{
    public function index(Request $request)
    {
        return new Home($request);
    }

}