<?php

namespace App\Http\Controllers\Gestion;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Modelos\Vistas\ViewListarServicios;
use App\Modelos\Vistas\ViewListarMoviles;
use App\Modelos\Vistas\ViewListarPropietarios;
use App\Modelos\Vistas\ViewListarExpediciones;

use App\Modelos\Expedicion;


class ExpedicionesController extends Controller
{	
    public function listarExpediciones(Request $request)
    {
        try{
            if($request->ajax()){
                $servicios = $request->servicios;
                $listado = [];
                foreach ($servicios as $servicio)
                {
                    $expediciones = ViewListarExpediciones::where('codi_servi', $servicio['codi_servi'])
                                                        ->where('codi_circu', $servicio['codi_circu'])
                                                        ->where('nume_movil', $servicio['nume_movil'])
                                                        ->where('procesar', true)
                                                        ->get();

                    array_push($listado, $expediciones->toArray());
                }
                $mensaje = 'Expediciones encontradas exitosamente.';
                return response()->json([
                    'msg' => $mensaje,
                    'listado' => $listado
                ], 200);
            }
        } catch (\Exception $e){
                return response('Algo salio mal...!!!', 500);
        }
    }

    public function listarExpediciones2(Request $request)
    {
        if($request->ajax()){
            $servicio = $request->servicio;
            try{
                $lst = ViewListarExpediciones::where('codi_servi', $servicio['codi_servi'])
                        ->where('codi_circu', $servicio['codi_circu'])
                        ->where('nume_movil', $servicio['nume_movil'])
                        ->get();
                
                if($lst->count() > 0){
                    $mensaje = 'El Movil: ' .$servicio['nume_movil']. ' Tiene: ' .$lst->count(). ' Expediciones para Procesar.';
                    return response()->json([
                            'listado'   => $lst->toArray(),
                            'msg'           => $mensaje
                    ], 200);
                } else {
                    return response('No se Encontraron Servicios para Procesar.', 404);
                }
            } catch (\Exception $e){
                return response('Algo salio mal...!!!', 500);
            }
        }
    }
}