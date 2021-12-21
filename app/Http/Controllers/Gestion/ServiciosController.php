<?php

namespace App\Http\Controllers\Gestion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Responsables\Gestion\Servicios\Home;

use App\Http\Responsables\Modulos\BuscarConductor;
use App\Http\Responsables\Modulos\BuscarMovil;

use App\Http\Responsables\Gestion\Servicios\Buscar;
use App\Http\Responsables\Gestion\Servicios\Eliminar;
use App\Http\Responsables\Gestion\Servicios\Filtrar;
use App\Http\Responsables\Gestion\Servicios\Listar;
use App\Http\Responsables\Gestion\Servicios\Registrar;
use App\Http\Responsables\Gestion\Servicios\CobrarMulta;

use App\Http\Responsables\Gestion\Imprimir\Servicios as ImprimirServicio;
use App\Http\Responsables\Gestion\Imprimir\Informes as ImprimirInforme;

use App\Http\Responsables\Modulos\AnalizarServicios;
use App\Http\Responsables\Modulos\ProcesarServicios;

class ServiciosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->_docu_empre = 11222333;
    }

    public function index(Request $request)
    {
        return new Home($request);
    }
    /*--------------------------------------------------*/
    public function analizarServicios(Request $request)
    {
        return new AnalizarServicios($request, $this->_docu_empre);
    }

    public function buscar(Request $request)
    {
        return new Buscar($request, $this->_docu_empre);
    }
    /*--------------------------------------------------*/
    public function buscarMovil(Request $request)
    {
        return new BuscarMovil($request);
    }

    public function buscarConductor(Request $request)
    {
        return new BuscarConductor($request);
    }
    /*--------------------------------------------------*/
    public function eliminar(Request $request)
    {
        return new Eliminar($request, $this->_docu_empre);
    }

    public function filtrar(Request $request)
    {
        return new Filtrar($request, $this->_docu_empre);
    }

    public function listar(Request $request)
    {
        return new Listar($request, $this->_docu_empre);
    }

    public function registrar(Request $request)
    {
        return new Registrar($request, $this->_docu_empre);
    }
    /*--------------------------------------------------*/
    public function procesarServicio(Request $request)
    {
        $imprimir = false;
        return new ProcesarServicios($request, $this->_docu_empre, $imprimir);
    }
    /*--------------------------------------------------*/
    public function cobrarMulta(Request $request)
    {
        return new CobrarMulta($request, $this->_docu_empre);
    }
    /*--------------------------------------------------*/
    public function imprimir(Request $request)
    {
        return new ImprimirServicio($request, $this->_docu_empre);
    }

    public function imprimirInforme(Request $request)
    {
        return new ImprimirInforme($request, $this->_docu_empre);
    }
}
