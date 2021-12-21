<?php

namespace App\Http\Responsables\Manager\Moviles;

use Illuminate\Contracts\Support\Responsable;

use App\Modelos\DBLatinsoft\Nacionalidad;
use App\Modelos\DBGestra\ViewPropietarios;

class Home implements Responsable
{
    protected $_docu_empre = '11222333';

    public function __construct($request)
    {
    }

    public function toResponse($request)
    {
        $docu_empre = $this->_docu_empre;
        $data =
            [
                'title'     => 'Manager',
                'subtitle'  => 'Moviles',
                'buscare'   => 'pate_movil',
                'lstPropietarios' => $this->_listar($docu_empre),
            ];
        return view('manager.moviles.vista', compact('data'));
    }

    public static function _listar($docu_empre)
    {
        try {
            $listado = ViewPropietarios::where('docu_empre', $docu_empre)
                ->where('habilitado', true)
                ->orderBy('prim_nombr')
                ->pluck('propietario', 'docu_perso')
                ->all();
            return $listado;
        } catch (\Exception $e) {
            \DB::rollback();
            return response('Error en el Servidor...!!!', 500);
        }
    }
}
