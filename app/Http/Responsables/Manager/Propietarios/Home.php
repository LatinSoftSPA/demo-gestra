<?php

namespace App\Http\Responsables\Manager\Propietarios;

use Illuminate\Contracts\Support\Responsable;

use App\Modelos\DBLatinsoft\Nacionalidad;
use App\Modelos\DBLatinsoft\ECivil;
use App\Modelos\DBLatinsoft\Provincia;

class Home implements Responsable
{

    public function __construct($request)
    {
    }

    public function toResponse($request)
    {
        $data = 
        [
            'title'     => 'Manager',
            'subtitle'  => 'Propietarios',
            'buscare'   => 'apellido_buscar',
            'lstNacionalidades' => Nacionalidad::_listar(),
            'lstECiviles'       => ECivil::_listar(),
            'lstProvincias'     => Provincia::_listar(),
        ];
        return view('manager.propietarios.vista', compact('data'));
    }
}