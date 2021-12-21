<?php

namespace App\Http\Responsables\Manager\Conductores;

use Illuminate\Contracts\Support\Responsable;

use App\Modelos\DBGestra\Conductor;
use App\Modelos\DBGestra\Licencia;

use App\Modelos\DBLatinsoft\Persona;
use App\Modelos\DBLatinsoft\Domicilio;
use App\Modelos\DBLatinsoft\Contacto;

class Guardar implements Responsable
{
    protected $_docu_empre;

    public function __construct($request, $docu_empre)
    {
        $this->_docu_empre = $docu_empre;
    }

    public function toResponse($request)
    {
        if (!$this->_existeConductor($request->toArray())) {
            Conductor::create($request->toArray());
            Licencia::create($request->toArray());
            if (!$this->_existePersona($request->toArray())) {
                Domicilio::create($request->toArray());
                Contacto::create($request->toArray());
                Persona::create($request->toArray());
            }

            $mensaje = 'Conductor Agregado Correctamente.';
            return response()->json([
                'msg' => $mensaje
            ], 200);
        }

        $mensaje = 'Este Conductor ya Existe en Nuestra Base de Datos.';
        return response()->json([
            'msg' => $mensaje
        ], 500);
    }

    /*--------------------------------------------------------------------------------------*/
    public function _existeConductor($obj)
    {
        $existe = false;
        $docu_perso = $obj['docu_perso'];
        $docu_empre = $this->_docu_empre;
        $conductor = Conductor::where('docu_empre', $docu_empre)->where('docu_perso', $docu_perso)->get();
        if ($conductor->count() > 0) {
            $existe = true;
        }
        return $existe;
    }

    private function _existePersona($obj)
    {
        $existe = false;
        $docu_perso = $obj['docu_perso'];
        $conductor = Persona::_buscar($docu_perso);
        if ($conductor->count() > 0) {
            $existe = true;
        }
        return $existe;
    }
}
