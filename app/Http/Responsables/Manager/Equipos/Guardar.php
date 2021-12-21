<?php

namespace App\Http\Responsables\Manager\Moviles;

use Illuminate\Contracts\Support\Responsable;

use App\Modelos\DBGts\Device;

class Guardar implements Responsable
{
    protected $_docu_empre = '96711420';

    public function __construct()
    {
    }

    public function toResponse($request)
    {
        if(!$this->_existeEquipo($request->toArray())){
            Device::create($request->toArray());

            $mensaje = 'Equipo Agregado Correctamente.';
            return response()->json([
                'msg' => $mensaje
            ], 200);
        }

        $mensaje = 'Este Equipo ya Existe en Nuestra Base de Datos.';
        return response()->json([
            'msg' => $mensaje
        ], 500);
    }

    /*--------------------------------------------------------------------------------------*/
    private function _existeEquipo($obj)
    {
        $existe = false;
        $docu_perso = $obj['docu_perso'];
        $docu_empre = $this->_docu_empre;
        $movil = Device::where('deviceID', $obj['deviceID'])
            ->where('imeiNumber', $obj['imeiNumber'])
            ->where('accountID', $obj['accountID'])
            ->where('groupID', $obj['groupID'])
            ->limit(1)
            ->get();
        if($movil->count() > 0){
            $existe = true;
        }
        return $existe;
    }
}