<?php

namespace App\Http\Responsables\Gestion\Servicios;

use Illuminate\Contracts\Support\Responsable;

use App\Modelos\DBServicios\Servicio;
use App\Modelos\DBServicios\Expedicion;
use App\Modelos\DBServicios\Programada;

use App\Modelos\DBServicios\Multa;
//use App\Modelos\Pago;

class Eliminar implements Responsable
{
    protected $_codi_circu;
    protected $_codi_servi;
    protected $_nume_movil;
    protected $_pate_movil;

    protected $_docu_empre;

    public function __construct($request, $docu_empre)
    {
        $this->_codi_circu = $request->codi_circu;
        $this->_codi_servi = $request->codi_servi;
        $this->_nume_movil = $request->nume_movil;
        $this->_pate_movil = $request->pate_movil;
        $this->_docu_empre = $docu_empre;
    }

    public function toResponse($request)
    {
        $docu_empre = $this->_docu_empre;
        $codi_circu = $this->_codi_circu;
        $codi_servi = $this->_codi_servi;
        $nume_movil = $this->_nume_movil;
        $pate_movil = $this->_pate_movil;

        \DB::beginTransaction();
        try {
            Servicio::where('codi_servi', $codi_servi)->where('nume_movil', $nume_movil)->where('codi_circu', $codi_circu)->delete();
            Expedicion::where('codi_servi', $codi_servi)->where('codi_circu', $codi_circu)->delete();
            Programada::where('codi_servi', $codi_servi)->where('codi_circu', $codi_circu)->delete();
            /*
            $multa = new Multa::where('codi_servi', $codi_servi)->
                where('codi_circu', $codi_circu)->get();
            if($multa->count() >0 ){$multa->delete();}
            */
            /*
            Pago::where('codi_servi', $codi_servi)->
                where('codi_circu', $codi_circu)->
                //where('nume_movil', $nume_movil)->
                delete();
            */
            $mensaje = 'El Servicio se ha Eliminado Correctamente.';
            return response()->json([
                'msg' => $mensaje
            ], 200);
        } catch (\Exception $e) {
            \DB::rollback();
            return response('Algo salio mal...!!!', 500);
        } finally {
        }
        \DB::commit();
    }
}
