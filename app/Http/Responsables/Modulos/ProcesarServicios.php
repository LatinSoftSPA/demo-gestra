<?php

namespace App\Http\Responsables\Modulos;

use Illuminate\Contracts\Support\Responsable;

use App\Modelos\DBGts\Marcada;
use App\Modelos\DBServicios\Programada;
use App\Modelos\DBServicios\Multa;
use App\Modelos\DBServicios\ViewServicios;
use App\Modelos\DBServicios\ViewProgramasXControlar;
use App\Modelos\Vistas\ViewArribos;

use App\Http\Controllers\Gestion\ProgramadasController;
use App\Http\Controllers\Imprimir\InformesController as ImprimirInforme;

use DB;
use Carbon\Carbon;

class ProcesarServicios implements Responsable
{
    protected $_imprimir;
    protected $_codi_circu;
    protected $_codi_equip;
    protected $_codi_servi;
    protected $_nume_movil;
    protected $_pate_movil;
    protected $_docu_empre;
    protected $_valor_multa;

    public function __construct($request, $docu_empre)
    {
        $this->_valor_multa = 1000;
        $this->_docu_empre = $docu_empre;
        $this->_imprimir = $request->impr_infor;
        $this->_codi_circu = $request->codi_circu;
        $this->_codi_equip = $request->codi_equip;
        $this->_codi_servi = $request->codi_servi;
        $this->_nume_movil = $request->nume_movil;
        $this->_pate_movil = $request->pate_movil;
    }

    public function toResponse($request)
    {
        $docu_empre = $this->_docu_empre;
        $codi_circu = $this->_codi_circu;
        $codi_servi = $this->_codi_servi;

        $objeto = ViewServicios::_buscar($docu_empre, $codi_circu, $codi_servi);

        if (isset($objeto)) {
            $listado = $this->_listarMarcadas($objeto['controladas']);
            Programada::_actualizarListadoProgramadas($listado);
            $multas = $this->_listarMultas($objeto, $listado);
            $this->_procesarListadoMultas($multas);
            if ($this->_imprimir) {
                //IMPRIMIR INFORME DEL SERVICIO
                $this->_imprimirInforme($docu_empre, $codi_circu, $codi_servi); //TODO: HABILITAR SI CHECK
            }
            $mensaje = 'Servicio Procesado Correctamente.';
            return response()->json([
                'msg' => $mensaje
            ], 200);
        }
    }


    private function _listarMarcadas($controladas)
    {
        $listado = [];
        foreach ($controladas as $controlar) {
            $minu_toler = $controlar['minu_toler'];
            $codi_equip = $controlar['codi_equip'];
            $latitude1 = $controlar['latitude1'];
            $longitude1 = $controlar['longitude1'];
            $fech_progr = $controlar['fech_progr'];
            $data = Marcada::_buscarMarcada($codi_equip, $latitude1, $longitude1, $fech_progr);

            if (isset($data[0])) {
                $controlada['codi_servi'] = $controlar['codi_servi'];
                $controlada['codi_circu'] = $controlar['codi_circu'];
                $controlada['codi_senti'] = $controlar['codi_senti'];
                $controlada['codi_geoce'] = $controlar['codi_geoce'];

                $multa = $this->_calcularMulta($minu_toler, $fech_progr, $data[0]['timestamp']);

                $controlada['angulo'] = intval($data[0]['heading']);
                $controlada['velo_contr'] = intval($data[0]['speedKPH']);
                $controlada['lati_marca'] = $data[0]['latitude'];
                $controlada['long_marca'] = $data[0]['longitude'];
                $controlada['geoz_marca'] = $data[0]['geozoneID'];
                $controlada['fech_contr'] = Carbon::createFromTimestamp($data[0]['timestamp'])->toDateTimeString();
                // $controlada['fech_marca'] = Carbon::createFromTimestamp($data[0]['timestamp'])->format('Y-m-d H:i:s');
                $controlada['dife_contro'] = $multa['diferencia'];
                $controlada['tota_multa'] = $multa['tota_multa'];
                $controlada['multado'] = $multa['multado'];
                array_push($listado, $controlada);
            }
        }
        return $listado;
    }

    private function _listarMultas($objeto, $listado)
    {
        $multas = [];
        $total_ida = 0;
        $total_reg = 0;
        foreach ($listado as $marcada) {
            $multas['codi_servi'] = $objeto['servicio']['codi_servi'];
            $multas['codi_circu'] = $objeto['servicio']['codi_circu'];
            $multas['nume_movil'] = $objeto['servicio']['nume_movil'];
            $multas['docu_empre'] = $objeto['servicio']['docu_empre'];
            $multas['fech_multa'] = Carbon::createFromTimestamp($objeto['servicio']['codi_servi'])->toDateTimeString();
            if ($marcada['multado']) {

                if ($marcada['codi_senti'] === 0) {
                    $total_ida = $total_ida + $marcada['tota_multa'];

                    $multas['expediciones'][$marcada['codi_senti']]['codi_senti'] = $marcada['codi_senti'];
                    $multas['expediciones'][$marcada['codi_senti']]['tota_multa'] = $total_ida;
                }
                if ($marcada['codi_senti'] === 1) {
                    $total_reg = $total_reg + $marcada['tota_multa'];
                    $multas['expediciones'][$marcada['codi_senti']]['codi_senti'] = $marcada['codi_senti'];
                    $multas['expediciones'][$marcada['codi_senti']]['tota_multa'] = $total_reg;
                }
                $multas['multado'] = true;
            }
        }
        return $multas;
    }
    /*------------------------------------------------------------------------------------------------------------------------------*/
    public function _procesarListadoMultas($listado)
    {
        $docu_empre = $listado['docu_empre'];
        $codi_circu = $listado['codi_circu'];
        $codi_servi = $listado['codi_servi'];
        $nume_movil = $listado['nume_movil'];
        $fech_multa = date('Y-m-d', $listado['codi_servi']);
        $user_modif =  0;
        foreach ($listado['expediciones'] as $expedicion) {
            $codi_senti = $expedicion['codi_senti'];
            $tota_multa = $expedicion['tota_multa'];

            $multa = Multa::_buscar($docu_empre, $codi_circu, $codi_servi, $codi_senti);
            if ($multa->count() === 0) {

                print_r([$docu_empre, $codi_servi, $codi_circu, $nume_movil, $codi_senti, $tota_multa, $fech_multa, $user_modif]);
                // Multa::definirMulta($docu_empre, $codi_servi, $codi_circu, $nume_movil, $codi_senti, $tota_multa, $fech_multa, $user_modif);
            }
        }
    }

    /*------------------------------------------------------------------------------------------------------------------------------*/
    private function _calcularMulta($minu_toler, $fech_progr, $fech_contr)
    {
        $diferencia = floor(($fech_contr - strtotime($fech_progr)) / 60);

        $multa['diferencia'] = $diferencia;
        $multa['multado'] = false;
        $multa['tota_multa'] = 0;

        if (intval($minu_toler) != 99) {
            $auxiliar = intval($diferencia) - intval($minu_toler);
            if ($auxiliar > 0) {
                $multa['multado'] = true;
                $multa['tota_multa'] = $auxiliar * $this->_valor_multa;
            } elseif (intval($diferencia) > 0) {
                $multa['tota_multa'] = $diferencia * $this->_valor_multa;
            }
        }
        return $multa;
    }
    /*------------------------------------------------------------------------------------------------------------------------------*/
    private function _imprimirInforme($docu_empre, $codi_circu, $codi_servi)
    {
        $servicio = ViewServicios::_buscar($docu_empre, $codi_circu, $codi_servi);
        if ($servicio['total'] > 0) {
            $mi_servicio = $servicio;
            $tu_servicio = null;
            if ($servicio['servicio']['serv_anter'] !== null) {
                $servicio = ViewServicios::_buscar($docu_empre, $codi_circu, $servicio['servicio']['serv_anter']);
                $tu_servicio = $servicio;
            }
            $informe_impreso = new ImprimirInforme;
            $informe_impreso->imprimir($mi_servicio, $tu_servicio);
        }
    }
}
