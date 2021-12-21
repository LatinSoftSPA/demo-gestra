<?php

namespace App\Http\Controllers\Gestra;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Modelos\DBServicios\ViewListarPuntosControl;

class PuntosControlController extends Controller
{
    /*
    public function __construct()
    {
        $this->middleware('auth');
    }
    */

    public function listar(Request $request)
    {    
        //if($request->ajax()){}
        $codi_circu = $request->codi_circu;
        $docu_empre = $this->_docu_empre;
        try
        {
            $lst = ViewListarPuntosControl::listar($codi_circu, $docu_empre);
            return $lst;
        } catch (\Exception $e){
            return response('Algo salio mal...!!!', 500);
        }
    }
}