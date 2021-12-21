<?php

namespace App\Http\Responsables\Manager\Propietarios;

use Illuminate\Contracts\Support\Responsable;

use App\Modelos\DBGestra\Propietario;

class Eliminar implements Responsable
{
	protected $_docu_empre = '96711420';
    protected $_docu_perso;

	public function __construct($request)
	{
        $this->_docu_perso = $request->docu_perso;
	}

	public function toResponse($request)
	{
        $docu_empre = $this->_docu_empre;
        $docu_perso = $this->_docu_perso;

        \DB::beginTransaction();
        try
        {            
            Propietario::_eliminar($docu_perso);
            $mensaje = 'El Propietario se ha Eliminado Correctamente.';
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