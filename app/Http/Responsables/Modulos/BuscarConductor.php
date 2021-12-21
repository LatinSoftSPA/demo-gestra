<?php

namespace App\Http\Responsables\Modulos;

use Illuminate\Contracts\Support\Responsable;

use App\Modelos\DBGestra\ViewConductores;

class BuscarConductor implements Responsable
{
    protected $_codi_licen;

    protected $_docu_empre = '11222333';

    public function __construct($request)
    {
        $this->_codi_licen = $request->codi_licen;
    }

    public function toResponse($request)
    {
        $docu_empre = $this->_docu_empre;
        $codi_licen = $this->_codi_licen;

        $conductor = ViewConductores::_buscar($docu_empre, $codi_licen);

        if ($conductor->count() > 0) {
            $dias = $this->_diferenciasEntreFecha($conductor[0]->fech_venci);
            return response()->json([
                'conductor' => $conductor[0]->toArray(),
                'total'     => $conductor->count(),
                'dias'      => $dias + 1
            ], 200);
        } else {
            return response('Nota: No se Encontro el Conductor "COD: ' . $codi_licen . '"', 404);
        }
    }

    private function _diferenciasEntreFecha($fech_venci)
    {
        $fech_actua = new \DateTime("now");
        $fech_venci = new \DateTime($fech_venci);
        $diferencia = $fech_venci->diff($fech_actua);
        $diferencia = ($diferencia->invert <= 0) ? ($diferencia->days * -1) : $diferencia->days;
        return $diferencia;
    }
}
