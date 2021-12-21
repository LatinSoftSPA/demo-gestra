<?php

namespace App\Http\Responsables\Manager\Conductores;

use Illuminate\Contracts\Support\Responsable;

use App\Modelos\DBGestra\Conductor;
use App\Modelos\DBGestra\Licencia;

use App\Modelos\DBLatinsoft\Persona;
use App\Modelos\DBLatinsoft\Domicilio;
use App\Modelos\DBLatinsoft\Contacto;

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
            $this->_actualizarPersona($request->toArray());
            $this->_actualizarLicencia($request->toArray());
            $this->_actualizarCondutor($request->toArray());
            $this->_actualizarDomicilio($request->toArray());
            $this->_actualizarContacto($request->toArray());
            $msg = 'Conductor Actualizado Correctamente';
            return response()->json([
                            'msg' => $msg
                    ], 200);
        } catch (\Exception $e){
            return response('No se Logro Actualizar el Conductor...!!', 500);
        }
	}

    private function _actualizarCondutor($obj)
    {
        \DB::beginTransaction();
        try
        {
            $conductor = new Conductor($obj);
            $conductor['user_modif'] = \Auth::user()->docu_perso;
            Conductor::where('docu_perso', $obj['docu_perso'])->update($conductor->toArray());
        } catch (\Exception $e){
            \DB::rollback();
            return response('No se Logro Actualizar el Conductor...!!', 500);
        }
        \DB::commit();
    }

    private function _actualizarLicencia($obj)
    {
        \DB::beginTransaction();
        try
        {
            $licencia = new Licencia($obj);
            $licencia['user_modif'] = \Auth::user()->docu_perso;
            Licencia::where('docu_perso', $obj['docu_perso'])->update($licencia->toArray());
        } catch (\Exception $e){
            \DB::rollback();
            return response('No se Logro Actualizar el Conductor...!!', 500);
        }
        \DB::commit();
    }

    private function _actualizarPersona($obj)
    {
        \DB::beginTransaction();
        try
        {
            $persona = new Persona($obj);
            $persona['user_modif'] = \Auth::user()->docu_perso;
            Persona::where('docu_perso', $obj['docu_perso'])->update($persona->toArray());
        } catch (\Exception $e){
            \DB::rollback();
            return response('No se Logro Actualizar el Conductor...!!', 500);
        }
        \DB::commit();
    }

    private function _actualizarDomicilio($obj)
    {
        \DB::beginTransaction();
        try
        {
            $domicilio = new Domicilio($obj);
            Domicilio::where('docu_perso', $obj['docu_perso'])->update($domicilio->toArray());
        } catch (\Exception $e){
            \DB::rollback();
            return response('No se Logro Actualizar el Conductor...!!', 500);
        }
        \DB::commit();
    }

    private function _actualizarContacto($obj)
    {
        \DB::beginTransaction();
        try
        {
            $contacto = new Contacto($obj);
            Contacto::where('docu_perso', $obj['docu_perso'])->update($contacto->toArray());
        } catch (\Exception $e){
            \DB::rollback();
            return response('No se Logro Actualizar el Conductor...!!', 500);
        }
        \DB::commit();
    }
}