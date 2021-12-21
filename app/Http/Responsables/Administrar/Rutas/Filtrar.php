<?php

namespace App\Http\Responsables\Administrar\Rutas;

use Illuminate\Contracts\Support\Responsable;

use App\Modelos\DBServicios\ViewRutas;

class Filtrar implements Responsable
{
    protected $_docu_empre = '96711420';
    protected $_nomb_ruta;

    public function __construct($request)
    {
        $this->_nomb_ruta = $request->nomb_ruta;
    }

    public function toResponse($request)
    {
        $docu_empre = $this->_docu_empre;
        $nomb_ruta = $this->_nomb_ruta;
        
        try{
            $lst = ViewRutas::_filtrar($nomb_ruta, $docu_empre);
            return response()->json([
                    'listado' => $lst->all(),
                    'total' => $lst->count()
            ], 200);
        } catch (\Exception $e){
            return response('Algo salio mal...!!!', 500);
        }
    }
}