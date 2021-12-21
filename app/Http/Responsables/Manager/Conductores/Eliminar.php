<?php

namespace App\Http\Responsables\Manager\Conductores;

use Illuminate\Contracts\Support\Responsable;

use App\Modelos\DBGestra\Conductor;
use App\Modelos\DBGestra\Licencia;

use App\Modelos\DBLatinsoft\Persona;
use App\Modelos\DBLatinsoft\Domicilio;
use App\Modelos\DBLatinsoft\Contacto;

class Eliminar implements Responsable
{
	protected $_docu_empre = '96711420';
    protected $_docu_perso;
    protected $_codi_licen;

	public function __construct($request)
	{
        $this->_docu_perso = $request->docu_perso;
        $this->_codi_licen = $request->codi_licen;
	}

	public function toResponse($request)
	{
        $docu_empre = $this->_docu_empre;
        $docu_perso = $this->_docu_perso;
        $codi_licen = $this->_codi_licen;

        \DB::beginTransaction();
        try
        {            
            Conductor::_eliminar($docu_perso);
            Licencia::_eliminar($docu_perso);
            $mensaje = 'El Conductor se ha Eliminado Correctamente.';
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