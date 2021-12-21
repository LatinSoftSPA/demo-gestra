<?php

namespace App\Http\Responsables\Manager\Moviles;

use Illuminate\Contracts\Support\Responsable;

use App\Modelos\DBGestra\Movil;

class Actualizar implements Responsable
{
    public function __construct($request)
    {
    }

    public function toResponse($request)
    {
        try {
            $this->_actualizarMovil($request->toArray());
            $msg = 'Movil Actualizado Correctamente';
            return response()->json([
                'msg' => $msg
            ], 200);
        } catch (\Exception $e) {
            return response('No se Logro Actualizar el Movil...!!', 500);
        }
    }

    private function _actualizarMovil($obj)
    {
        \DB::beginTransaction();
        try {
            $movil = new Movil($obj);
            $movil['user_modif'] = \Auth::user()->docu_perso;
            Movil::where('pate_movil', $obj['pate_movil'])
                ->where('nume_movil', $obj['nume_movil'])
                ->update($movil->toArray());
        } catch (\Exception $e) {
            \DB::rollback();
            return response('No se Logro Actualizar el Movil...!!', 500);
        }
        \DB::commit();
    }
}
