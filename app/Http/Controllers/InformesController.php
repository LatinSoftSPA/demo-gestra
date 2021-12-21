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

    public function informeMiFlota($codi_linea, $docu_empre, $docu_perso)
    {
        $misDatos = ViewListarPropietarios::
                    where('docu_empre', $docu_empre)->
                    where('docu_perso', $docu_perso)->
                    get();


        $misMoviles = ViewListarMoviles::
                    where('docu_empre', $docu_empre)->
                    where('docu_perso', $docu_perso)->
                    get();

        $laFlota = [];
        $losMoviles = [];
        foreach ($misMoviles as $obj)
        {
            //dd($obj);
            $nume_movil = $obj->nume_movil;
            $pate_movil = $obj->pate_movil;
            $codi_equip = $obj->codi_equip;

            $desde = strtotime(date("Y-n-j", strtotime("first day of this month")));
            $hasta = strtotime(date("Y-n-j", strtotime("last day of this month")));
            
            $losServicios = ViewListarServicios::
                        where('nume_movil', $nume_movil)->
                        where('pate_movil', $pate_movil)->
                        whereBetween('codi_servi', [$desde, $hasta])->
                        orderBy('inic_servi', 'ASC')->
                        get();

            $obj->misServicios = $losServicios->toArray();
			array_push($losMoviles, ['codi_equip' => $codi_equip, 'nume_movil' => $nume_movil, 'pate_movil' => $pate_movil]);
            array_push($laFlota, $obj);
        }

        $data = [
            'title'     => 'Manager',
            'subtitle'  => 'Sistema de Gestion'
        ];
        return view('informes.miFlota.vista', compact('misDatos', 'laFlota', 'losMoviles', 'data'));
    }


    public function miServicio($codi_circu, $codi_servi)
    {
        $miServicio = ViewListarServicios::
                    where('codi_servi', $codi_servi)->
                    where('codi_circu', $codi_circu)->
                    get();
        if($miServicio->count() > 0)
        {
            $misProgramadas = ViewListarProgramadas::
                        where('codi_servi', $codi_servi)->
                        where('codi_circu', $codi_circu)->
                        get();
            $tuServicio = ViewListarServicios::
                        where('codi_servi', $miServicio[0]['serv_anter'])->
                        where('codi_circu', $codi_circu)->
                        get();
            $tusProgramadas = ViewListarProgramadas::
                        where('codi_servi', $miServicio[0]['serv_anter'])->
                        where('codi_circu', $codi_circu)->
                        get();
            return view('informes.miServicio.vista', compact('miServicio', 'misProgramadas', 'tuServicio', 'tusProgramadas'));

        }

        return response()->view('errors.404', [], 404);
    }
}
