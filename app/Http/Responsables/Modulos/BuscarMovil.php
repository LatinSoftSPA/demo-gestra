<?php

namespace App\Http\Responsables\Modulos;

use Illuminate\Contracts\Support\Responsable;

use App\Modelos\DBGestra\ViewMoviles;

class BuscarMovil implements Responsable
{
    protected $_nume_movil;
    protected $_pate_movil;

    protected $_docu_empre = '11222333';

    public function __construct($request)
    {
        $this->_nume_movil = $request->nume_movil;
        $this->_pate_movil = $request->pate_movil;
    }

    public function toResponse($request)
    {
        $docu_empre = $this->_docu_empre;
        $nume_movil = $this->_nume_movil;

        $movil = ViewMoviles::_buscar($docu_empre, $nume_movil);

        if ($movil->count() > 0) {
            $dias = $this->_diferenciasEntreFecha($movil[0]->fech_revis);
            return response()->json([
                'movil'     => $movil[0]->toArray(),
                'total'     => $movil->count(),
                'dias'      => $dias + 1,
            ], 200);
        } else {
            return response('No se Encontro el Movil "N°: <b>' . $nume_movil . '"</b> en nuetra Base de Datos.', 404);
        }
    }

    private function _diferenciasEntreFecha($fech_revis)
    {
        $fech_actua = new \DateTime("now");
        $fech_revis = new \DateTime($fech_revis);
        $diferencia = $fech_revis->diff($fech_actua);
        $diferencia = ($diferencia->invert <= 0) ? ($diferencia->days * -1) : $diferencia->days;
        return $diferencia;
    }
}
