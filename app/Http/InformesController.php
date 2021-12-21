<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Modelos\Vistas\ViewListarServicios;
use App\Modelos\Vistas\ViewListarProgramadas;
use App\Modelos\Vistas\ViewListarMoviles;
use App\Modelos\Vistas\ViewListarPropietarios;
use App\Modelos\Vistas\ViewListarExpediciones;

use App\Modelos\Expedicion;


class InformesController extends Controller
{
    protected $_docu_empre = '96711420';

    public function index()
    {
        $title = 'Gestion de Expediciones';
        $back = route('manager');
        $search = ['expediciones.index', 'codi_servi'];
        
        return view('expediciones.vista', compact('title', 'back', 'search'));
    }


    public function listarExpediciones(Request $request)
    {
        if($request->ajax()){
            $servicios = $request->listado;
            $listado = [];
            foreach ($servicios as $servicio) {
                $expediciones = ViewListarExpediciones::where('codi_servi', $servicio['codi_servi'])
                                                    ->where('codi_circu', $servicio['codi_circu'])
                                                    ->where('nume_movil', $servicio['nume_movil'])
                                                    ->where('nume_movil', $servicio['nume_movil'])
                                                    ->get();

                array_push($listado, $expediciones->toArray());
            }

            return response()->json([
                    'listado' => $listado
            ]);
        }
    }

    public function store(Request $request)
    {
        try{
            if($request->ajax()){
                $expediciones = $request['expediciones'];

                foreach($expediciones as $expedicion){
                    $obj = new Expedicion($expedicion);
                    Expedicion::create($obj->toArray());
                }

                $mensaje = '<b>Nota: </b>Expedicion(es) Registrada(s) Correctamente.';
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
