<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


use App\Modelos\Nacionalidad;
use App\Modelos\ECivil;
use App\Modelos\Provincia;
use App\Modelos\Comuna;
use App\Modelos\Circuito;
use App\Modelos\Tiposusuario;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

	public $_zonaHoraria = "-3";
	
    protected $_docu_empre = '96711420';
    protected $_accountID = 'lineas-anf';
    protected $_groupID = 'linea-104-anf';


    protected function listadoNacionalidades(){
        return Nacionalidad::orderBy('nomb_nacio', 'ASC')
                            ->pluck('nomb_nacio', 'idde_nacio')
                            ->all();
    }

    protected function listadoECivil(){
        return ECivil::orderBy('nomb_ecivi', 'ASC')
                    ->pluck('nomb_ecivi', 'idde_ecivi')
                    ->all();
    }

    protected function listadoProvincias(){
        return Provincia::orderBy('nomb_provi', 'ASC')
                            ->pluck('nomb_provi', 'idde_provi')
                            ->all();
    }

    protected function listadoCircuitos(){
        return Circuito::orderBy('nomb_circu', 'ASC')
							->where('habilitado', 1)
                            ->pluck('nomb_circu', 'codi_circu')
                            ->all();
    }

    protected function listadoTUsuarios(){
        return Tiposusuario::orderBy('nomb_tipo', 'ASC')
                            ->pluck('nomb_tipo', 'idde_tipo')
                            ->all();

    }
}