<?php

namespace App\Http\Controllers\Track;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

use App\Modelos\Vistas\ViewArribos;

class ArribosController extends Controller
{
    public function listarArribos(Request $request)
    {
        if($request->ajax()){
            $expedicion = $request->expedicion;
            try
            {
                $desde = strtotime ( '-10 minutes' , strtotime($expedicion['inic_exped']));
                $hasta = strtotime ( '+40 minutes' , strtotime($expedicion['term_exped']));

                $arribos = ViewArribos::_listar($expedicion['codi_equip'], $desde, $hasta);

                if($arribos->count() > 0)
                {
                    if($expedicion['codi_senti'] == 0)
                    {
                        $sentido = 'IDA';
                    } else {
                        $sentido = 'REGRESO';
                    }

                    $mensaje = 'Hay: ' .$arribos->count(). ' Arribos encontradas.';
                    return response()->json([
                            'listado'   => $arribos->toArray(),
                            'total'     => $arribos->count(),

                            'nume_movil'=> $expedicion['nume_movil'],
                            'pate_movil'=> $expedicion['pate_movil'],
                            'codi_servi'=> $expedicion['codi_servi'],
                            'codi_senti'=> $expedicion['codi_senti'],
                            'sentido'   => $sentido,
                            'codi_circu'=> $expedicion['codi_circu'],
                            'inic_exped'=> $expedicion['inic_exped'],
                            'term_exped'=> $expedicion['term_exped'],

                            'conductor' => $expedicion['conductor'],
                            'docu_perso'=> $expedicion['docu_perso'],
                            'msg'       => $mensaje
                    ], 200);
                } else {
                    return response('No se Encontraron Arribos para Este Servicio.', 404);
                }
            } catch (\Exception $e){
                return response('Algo salio mal...!!!', 500);
            }
        }
    }
}