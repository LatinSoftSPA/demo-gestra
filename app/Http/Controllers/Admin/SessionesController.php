<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Modelos\Session;

class SessionesController extends Controller
{

    public function index(Request $request)
    {
    }
	
    public function store(Request $request)
    {
        if($request->ajax()){
            try{
                    $session = $request->session;

                    Session::create([
                        'docu_perso' => $data['docu_perso'],
                        'docu_empre' => $data['docu_empre'],
                        'fech_inici' => date("Y-m-d H:i:s"),
                        'ip' => '244.233.222.0',
                    ]);                
                    
                    
                    $mensaje = '<b>Nota: </b>Servicio Registrado Correctamente.';
                    return response()->json([
                        'msg' => $mensaje, 
                        'clr' => 'alert-success'
                    ], 200);
            } catch (\Exception $e){
                    return response('Algo salio mal...!!!', 500);
            }
        }
    }


    public function update(Request $request)
    {
        try{
            if($request->ajax()){
                $session = $request->session;
                Session::where('docu_perso', $session['docu_perso'])
                        ->where('docu_empre', $session['docu_empre'])
                        ->where('fech_inici', $session['fech_inici'])
                        ->where('ip', $session['ip'])
                        ->update(
                        [
                            'fech_termi'    => date("Y-m-d H:i:s")
                        ]);           

                $mensaje = '<b>Nota: </b>Session Actualizada Correctamente.';
                return response()->json([
                    'msg' => $mensaje, 
                    'clr' => 'alert-success'
                ], 200);
            }
        } catch (\Exception $e){
                return response('Algo salio mal...!!!', 500);
        }
    }
}