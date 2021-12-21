<?php

namespace App\Http\Responsables\Manager\Equipos;

use Illuminate\Contracts\Support\Responsable;

use App\Modelos\DBGts\ViewDevices;

class Actualizar implements Responsable
{
	protected $_docu_empre = '96711420';

	public function __construct($request)
	{        
    }

	public function toResponse($request)
	{
        try
        {
            $this->_actualizarEquipo($request->toArray());
            $msg = 'Equipo Actualizado Correctamente';
            return response()->json([
                            'msg' => $msg
                    ], 200);
        } catch (\Exception $e){
            return response('No se Logro Actualizar el Equipo...!!', 500);
        }
	}

    private function _actualizarEquipo($obj)
    {
        \DB::beginTransaction();
        try
        {
            $equipo = new ViewDevices($obj);
            //$equipo['user_modif'] = \Auth::user()->docu_perso;
            ViewDevices::where('deviceID', $obj['deviceID'])
                ->where('imeiNumber', $obj['imeiNumber'])
                ->where('accountID', $obj['accountID'])
                ->where('groupID', $obj['groupID'])
                ->update($equipo->toArray());
        } catch (\Exception $e){
            \DB::rollback();
            return response('No se Logro Actualizar el Equipo...!!', 500);
        }
        \DB::commit();
    }
}