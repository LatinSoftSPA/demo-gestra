<?php

namespace App\Http\Responsables\Manager\Propietarios;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\Input;

use App\Modelos\DBLatinsoft\Persona;
use App\Modelos\DBLatinsoft\Domicilio;
use App\Modelos\DBLatinsoft\Contacto;

use App\Modelos\DBGestra\Propietario;

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
            $this->_actualizarPropietario($request->toArray());
            $this->_actualizarPersona($request->toArray());
            $this->_actualizarDomicilio($request->toArray());
            $this->_actualizarContacto($request->toArray());
            $msg = 'Propietario Actualizado Correctamente';
            return response()->json([
                            'msg' => $msg
                    ], 200);
        } catch (\Exception $e){
            return response('No se Logro Actualizar el Propietario...!!', 500);
        }
	}

    private function _actualizarPropietario($obj)
    {
        \DB::beginTransaction();
        try
        {
            $conductor = new Propietario($obj);
            $conductor['user_modif'] = \Auth::user()->docu_perso;
            Propietario::where('docu_perso', $obj['docu_perso'])->update($conductor->toArray());
        } catch (\Exception $e){
            \DB::rollback();
            return response('No se Logro Actualizar el Propietario...!!', 500);
        }
        \DB::commit();
    }

    private function _actualizarPersona($request)
    {
        \DB::beginTransaction();
        try
        {
            $persona = new Persona($request);
            $persona['user_modif'] = \Auth::user()->docu_perso;
            Persona::where('docu_perso', $request['docu_perso'])->update($persona->toArray());
        } catch (\Exception $e){
            \DB::rollback();
            return response('No se Logro Actualizar el Conductor...!!', 500);
        }
        \DB::commit();
    }

    private function _actualizarDomicilio($request)
    {
        \DB::beginTransaction();
        try
        {
            $domicilio = new Domicilio($request);
            Domicilio::where('docu_perso', $request['docu_perso'])->update($domicilio->toArray());
        } catch (\Exception $e){
            \DB::rollback();
            return response('No se Logro Actualizar el Conductor...!!', 500);
        }
        \DB::commit();
    }

    private function _actualizarContacto($request)
    {
        \DB::beginTransaction();
        try
        {
            $contacto = new Contacto($request);
            Contacto::where('docu_perso', $request['docu_perso'])->update($contacto->toArray());
        } catch (\Exception $e){
            \DB::rollback();
            return response('No se Logro Actualizar el Conductor...!!', 500);
        }
        \DB::commit();
    }
}