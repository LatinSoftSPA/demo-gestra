<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Responsables\Administrar\Rutas\Home;

//use App\Http\Responsables\Administrar\Rutas\Actualizar;
//use App\Http\Responsables\Administrar\Rutas\Buscar;
//use App\Http\Responsables\Administrar\Rutas\Eliminar;
use App\Http\Responsables\Administrar\Rutas\Filtrar;
//use App\Http\Responsables\Administrar\Rutas\Guardar;
use App\Http\Responsables\Administrar\Rutas\Listar;


use App\Modelos\DBServicios\ViewRutas;
use App\Modelos\Vistas\ViewListarPuntosControl;

use App\Modelos\Ruta;

class RutasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        return new Home($request);
    }

    /*    
    public function actualizar(Request $request)
    {
        return new Actualizar($request);
    }
    public function buscar(Request $request)
    {
        return new Buscar($request);
    }

    public function eliminar(Request $request)
    {
        return new Eliminar($request);
    }
    */
    public function filtrar(Request $request)
    {
        return new Filtrar($request);
    }
    /*
    public function guardar(Request $request)
    {
        return new Guardar($request);
    }
    */
    public function listar(Request $request)
    {
        return new Listar($request);
    }






    public function edit($codi_ruta)
    {
        $ruta       = ViewRutas::find($codi_ruta);

        $controles  = ViewListarPuntosControl::where('codi_circu', $ruta->codi_circu)
            ->where('docu_empre', $this->_docu_empre)
            ->where('codi_senti', $ruta->codi_senti)
            ->get();

        $data =
            [
                'title'     => 'Editar',
                'subtitle'  => 'Ruta',

                'ruta'      => $ruta,
                'controles' => $controles,
            ];
        return view(
            'administrador.rutas.edit.vista',
            compact('data')
        );
    }

    public function show($codi_ruta)
    {
        try {
            $objeto = ViewRutas::find($codi_ruta);
            $puntos = ViewListarPuntosControl::where('codi_circu', $objeto->codi_circu)->where('codi_senti', $objeto->codi_senti)->where('docu_empre', $this->_docu_empre)->get();

            return response()->json([
                'ruta' => $objeto->toArray(),
                'listado' => $puntos->toArray()
            ], 200);
        } catch (\Exception $e) {
            return response('Algo salio mal...!!!', 500);
        }
        /*
        if($request->ajax()){
            $objeto = ViewListarRutas::find($codi_ruta);
            return $objeto;
        }
        */
    }
}
