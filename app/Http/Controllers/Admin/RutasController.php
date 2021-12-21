<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Modelos\Vistas\ViewListarRutas;
use App\Modelos\Vistas\ViewListarPuntosControl;

use App\Modelos\Ruta;

class RutasController extends Controller
{
    public function index()
    {
        $data = 
        [
            'title'     => 'Administracion',
            'subtitle'  => 'Rutas de Servicios',
            'buscare'   => 'nomb_ruta'
        ];

        return view('administrador.rutas.vista', compact('data'));
    }

    public function edit($codi_ruta)
    {
        $ruta       = ViewListarRutas::find($codi_ruta);

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
        return view('administrador.rutas.edit.vista', compact('data')
        );
    }

    public function show($codi_ruta)
    {
        try{
            $objeto = ViewListarRutas::find($codi_ruta);
            $puntos = ViewListarPuntosControl::
                where('codi_circu', $objeto->codi_circu)->
                where('codi_senti', $objeto->codi_senti)->
                where('docu_empre', $this->_docu_empre)->
                get();

            return response()->json([
                    'ruta' => $objeto->toArray(),
                    'listado' => $puntos->toArray()
            ], 200);
        } catch (\Exception $e){
            return response('Algo salio mal...!!!', 500);
        }
        /*
        if($request->ajax()){
            $objeto = ViewListarRutas::find($codi_ruta);
            return $objeto;
        }
        */
    }

    public function update(Request $request)
    {
        //
    }

    public function listarRutas(Request $request)
    {
        if($request->ajax()){
            try{
                $lst = ViewListarRutas::get();
                return response()->json([
                        'listado' => $lst->all(),
                        'total' => $lst->count()
                ], 200);
            } catch (\Exception $e){
                return response('Algo salio mal...!!!', 500);
            }
        }
    }

    public function filtrarRutas(Request $request)
    {
        $nomb_ruta = $request->nomb_ruta;
        try{
            $lst = ViewListarRutas::
                        where('nomb_ruta', 'LIKE', "%$nomb_ruta%")
                        ->get();
            //dd($lst->toArray());
            if($lst->count() > 0){
                return response()->json([
                        'listado'   => $lst->toArray(),
                        'total'     => $lst->count()
                ], 200);
            } else {
                return response('Nota: No se Encontraron RUTAS con ese Nombre...!!!', 404);
            }
            
        } catch (\Exception $e){
                return response('Algo salio mal...!!!', 500);
        }
    }
}