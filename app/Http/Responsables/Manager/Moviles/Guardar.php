<?php

namespace App\Http\Responsables\Manager\Moviles;

use Illuminate\Contracts\Support\Responsable;

use App\Modelos\DBGestra\Movil;

class Guardar implements Responsable
{
    protected $_docu_empre = '11222333';

    public function __construct()
    {
    }

    public function toResponse($request)
    {
        if (!$this->_existeMovil($request->toArray())) {
            Movil::create($request->toArray());

            $mensaje = 'Movil Agregado Correctamente.';
            return response()->json([
                'msg' => $mensaje
            ], 200);
        }

        $mensaje = 'Este Movil ya Existe en Nuestra Base de Datos.';
        return response()->json([
            'msg' => $mensaje
        ], 500);
    }

    /*--------------------------------------------------------------------------------------*/
    private function _existeMovil($obj)
    {
        $existe = false;
        $docu_empre = $this->_docu_empre;
        $movil = Movil::where('docu_empre', $docu_empre)
            ->where('pate_movil', $obj['pate_movil'])
            ->where('nume_movil', $obj['nume_movil'])
            ->limit(1)
            ->get();
        if ($movil->count() > 0) {
            $existe = true;
        }
        return $existe;
    }
}
