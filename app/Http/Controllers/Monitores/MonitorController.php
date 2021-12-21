<?php

namespace App\Http\Controllers\Monitores;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Http\Responsables\Vistas\PlanOperacional;
use App\Http\Responsables\Vistas\RegularidadServicios;

class MonitorController extends Controller
{
	public function planOperacional(Request $request)
    {
        return new PlanOperacional($request);
    }
    
    public function regularidadServicios(Request $request)
    {
        return new RegularidadServicios($request);
    }
}