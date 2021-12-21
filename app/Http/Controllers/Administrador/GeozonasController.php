<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Responsables\Administrar\Geozonas\Home;

use App\Http\Responsables\Administrar\Geozonas\Buscar;
use App\Http\Responsables\Administrar\Geozonas\Filtrar;
use App\Http\Responsables\Administrar\Geozonas\Listar;


use App\Modelos\DBGts\ViewGeozonas;

class GeozonasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request)
    {
        return new Home($request);
    }

    public function listar(Request $request)
    {
        return new Listar($request);
    }

    public function filtrar(Request $request)
    {
        return new Filtrar($request);
    }

    public function buscar(Request $request)
    {
        return new Buscar($request);
    }





    public function edit($geozonaID)
    {
        $data = 
        [
            'title'     => 'Editar',
            'subtitle'  => 'GeoZona',
            'listado'   => ViewGeozonas::find($geozonaID)
        ];

        //return view('administrador.geozonas.edit.vista', compact('data'));
    }
}
