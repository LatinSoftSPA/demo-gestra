<?php

namespace App\Http\Responsables\Manager\Propietarios;

use Illuminate\Contracts\Support\Responsable;

use App\Modelos\DBGestra\Propietario;

use App\Modelos\DBLatinsoft\Persona;
use App\Modelos\DBLatinsoft\Domicilio;
use App\Modelos\DBLatinsoft\Contacto;

class Guardar implements Responsable
{
    protected $_docu_empre = '96711420';

    public function __construct()
    {
    }

    public function toResponse($request)
    {
        if(!$this->_existePropietario($request->toArray())){
            Propietario::create($request->toArray());
            if(!$this->_existePersona($request->toArray())){
                Persona::create($request->toArray());
                Domicilio::create($request->toArray());
                Contacto::create($request->toArray());
            }

            $mensaje = 'Propietario Agregado Correctamente.';
            return response()->json([
                'msg' => $mensaje
            ], 200);
        }

        $mensaje = 'Este Propietario ya Existe en Nuestra Base de Datos.';
        return response()->json([
            'msg' => $mensaje
        ], 500);
    }

    /*--------------------------------------------------------------------------------------*/
    private function _existePropietario($obj)
    {
        $existe = false;
        $docu_perso = $obj['docu_perso'];
        $docu_empre = $this->_docu_empre;
        $conductor = Propietario::where('docu_perso', $docu_perso)
            ->where('docu_empre', $docu_empre)
            ->limit(1)
            ->get();
        if($conductor->count() > 0){
            $existe = true;
        }
        return $existe;
    }

    private function _existePersona($obj)
    {
        $existe = false;
        $docu_perso = $obj['docu_perso'];
        $conductor = Persona::where('docu_perso', $docu_perso)
            ->limit(1)
            ->get();
        if($conductor->count() > 0){
            $existe = true;
        }
        return $existe;
    }
}