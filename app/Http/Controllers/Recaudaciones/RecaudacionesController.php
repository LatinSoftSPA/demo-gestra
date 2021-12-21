<?php
namespace App\Http\Controllers\Recaudaciones;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Responsables\Recaudaciones\Estadisticas\Home;

class RecaudacionesController extends Controller
{

    public function index(Request $request)
    {
        return new Home($request);
    }
	
}