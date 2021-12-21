<?php

namespace App\Http\Controllers\Informes;
use App\Http\Responsables\Informes\Conductores\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ConductoresController extends Controller
{
    public function index(Request $request)
    {
        return new Home($request);
    }

}