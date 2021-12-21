<?php

namespace App\Http\Responsables\Manager\Moviles;

use Illuminate\Contracts\Support\Responsable;

use App\Modelos\DBGestra\Movil;

class Eliminar implements Responsable
{
	protected $_docu_empre = '96711420';
    protected $_pate_movil;
    protected $_nume_movil;

	public function __construct($request)
	{
        $this->_pate_movil = $request->pate_movil;
        $this->_nume_movil = $request->nume_movil;
	}

	public function toResponse($request)
	{
        $docu_empre = $this->_docu_empre;
        $pate_movil = $this->_pate_movil;
        $nume_movil = $this->_nume_movil;

        \DB::beginTransaction();
        try
        {            
            Movil::_eliminar($pate_movil, $nume_movil);
            $mensaje = 'El Movil se ha Eliminado Correctamente.';
            return response()->json([
                'msg' => $mensaje
            ], 200);
        } catch (\Exception $e){
            \DB::rollback();
            return response('Error al Tratar de Eliminar...!!!', 500);
        } finally {
        }
        \DB::commit();
	}
}