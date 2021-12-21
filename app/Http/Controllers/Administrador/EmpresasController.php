<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Modelos\Vistas\ViewListarEmpresas;
use App\Modelos\Provincia;

class EmpresasController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Administrador de Empresas';
        $back = route('administracion');
        $search = ['empresas.index', 'docu_empre'];

        $listado = ViewListarEmpresas::
                    //Search($request->docu_empre)->
        			paginate(15);

        return view('administrador.empresas.vista', compact('title', 'back', 'search', 'listado'));
    }

    public function create()
    {
        $title = 'Crear Empresa';
        $back = route('administracion');

        $lstProvincias = Provincia::orderBy('nomb_provi', 'ASC')
                        	->pluck('nomb_provi', 'idde_provi')
                        	->all();
        return view('administrador.empresas.create.vista', compact('title', 'back', 'lstProvincias'));
    }

    public function edit($docu_empre)
    {
    
    }

}