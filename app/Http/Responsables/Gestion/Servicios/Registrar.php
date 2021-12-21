<?php

namespace App\Http\Responsables\Gestion\Servicios;

use Illuminate\Contracts\Support\Responsable;

use App\Modelos\DBServicios\Servicio;
use App\Modelos\DBServicios\Expedicion;
use App\Modelos\DBServicios\Programada;

use App\Modelos\DBGestra\Movil;

use App\Modelos\DBServicios\ViewListarPuntosControl;
use App\Modelos\DBServicios\ViewServicios;

use App\Http\Controllers\Imprimir\ServiciosController as ImprimirServicio;

use Carbon\Carbon;

class Registrar implements Responsable
{
    protected $_codi_circu;
    protected $_nume_movil;
    protected $_pate_movil;
    protected $_codi_equip;
    protected $_docu_condu;
    protected $_codi_licen;
    protected $_fecha_hora;

    protected $_docu_empre;
    protected $_fech_servi;

    public function __construct($request, $docu_empre)
    {
        $this->_docu_empre = $docu_empre;
        $this->_codi_circu = $request->codi_circu;
        $this->_nume_movil = $request->nume_movil;
        $this->_pate_movil = $request->pate_movil;
        $this->_codi_equip = $request->codi_equip;
        $this->_docu_condu = $request->docu_condu;
        $this->_codi_licen = $request->codi_licen;
        $this->_fecha_hora = $request->fecha . ' ' . $request->hora;
        $this->_fech_servi = $request->fecha;
    }

    public function toResponse($request)
    {
        $docu_empre = $this->_docu_empre;
        $codi_circu = $this->_codi_circu;
        $nume_movil = $this->_nume_movil;
        $pate_movil = $this->_pate_movil;
        $codi_equip = $this->_codi_equip;
        $docu_condu = $this->_docu_condu;
        $codi_licen = $this->_codi_licen;
        $fecha_hora = $this->_fecha_hora;
        $fech_servi = Carbon::createFromTimeString($fecha_hora)->toDateTimeString();
        //$codi_servi = strtotime('-3', strtotime($fech_servi));
        $codi_servi = Carbon::createFromTimeString($fecha_hora)->timestamp;
        $imprimir = $request->imprimir;

        if ($this->_serviciosPendientes($docu_empre, $codi_circu, $nume_movil, $pate_movil, $fech_servi)) {
            $mensaje = 'Este Movil tiene Servicios Pendientes.';
            return response()->json([
                'msg' => $mensaje
            ], 500);
        }

        if (!$this->_existeServicio($docu_empre, $codi_servi, $codi_circu)) {
            $objeto = $this->_definir($codi_circu, $codi_servi, $nume_movil, $pate_movil, $codi_equip, $docu_condu, $codi_licen, $docu_empre, $fech_servi);


            \DB::beginTransaction();
            try {
                $servicio = $objeto['servicio'];
                Servicio::_crear($servicio);

                foreach ($objeto['controles'] as $controles) {
                    foreach ($controles['programadas'] as $programada) {
                        Programada::_crear($programada);
                    }
                }
                foreach ($objeto['expediciones'] as $expedicion) {
                    Expedicion::_crear($expedicion);
                }
                $this->_actualizarMovil($objeto['movil']);
                $mensaje = 'Servicio Registrado Correctamente.';
                return response()->json([
                    'msg' => $mensaje
                ], 200);
            } catch (\Exception $e) {
                \DB::rollback();
                return response('Algo salio mal...!!!', 500);
            } finally {
                if ($imprimir === "true") {
                    $this->_imprimirServicio($this->_docu_empre, $codi_circu, $codi_servi, $fech_servi);
                }
            }
            \DB::commit();
        } else {
            $mensaje = 'Este Servicio Ya Existe. <br>Verifique los datos Ingresados';
            return response()->json([
                'msg' => $mensaje
            ], 501);
        }
    }

    private function _listarServiciosXAnalizar($e, $c, $d, $h, $o)
    {
        $listado = Servicio::where('docu_empre', $e)
            ->where('codi_circu', $c)
            ->whereBetween('inic_servi', [$d, $h])
            ->where('procesar', false)
            ->orderBy('inic_servi', $o)
            ->get();

        return $listado;
    }

    private function _definir($codi_circu, $codi_servi, $nume_movil, $pate_movil, $codi_equip, $docu_condu, $codi_licen, $docu_empre, $fech_servi)
    {
        $programadas = $this->_definirProgramadas($codi_circu, $codi_servi, $nume_movil, $pate_movil, $fech_servi, $docu_empre);
        $expediciones = $this->_definirExpediciones($programadas, $codi_circu, $codi_servi, $nume_movil, $pate_movil, $docu_condu, $docu_empre);
        foreach ($programadas as $programada) {
            $inic_servi = $programada['inic_servi'];
            $term_servi = $programada['term_servi'];
        }
        $servicio = $this->_definirServicio($codi_servi, $codi_circu, $docu_empre, $docu_condu, $nume_movil, $pate_movil, $codi_equip, $inic_servi, $term_servi);

        $movil = $this->_definirMovil($nume_movil, $pate_movil, $codi_equip, $docu_empre, $docu_condu, $codi_licen, $codi_servi);
        return [
            'servicio'      => $servicio,
            'controles'     => $programadas,
            'expediciones'  => $expediciones,
            'movil'         => $movil
        ];
    }

    private function _definirMovil($nume_movil, $pate_movil, $codi_equip, $docu_empre, $docu_condu, $codi_licen, $codi_servi)
    {
        $movil['nume_movil'] = $nume_movil;
        $movil['pate_movil'] = $pate_movil;
        $movil['codi_equip'] = $codi_equip;
        $movil['docu_empre'] = $docu_empre;
        $movil['docu_condu'] = $docu_condu;
        $movil['codi_licen'] = $codi_licen;
        $movil['ulti_servi'] = $codi_servi;
        return $movil;
    }

    private function _definirServicio($codi_servi, $codi_circu, $docu_empre, $docu_perso, $nume_movil, $pate_movil, $codi_equip, $inic_servi, $term_servi)
    {
        $parametros = [$codi_circu, $codi_servi];
        $movil_anterior = \DB::select($this->_maquinaAnterior(), $parametros);
        $serv_anter = null;
        if (count($movil_anterior) > 0) {
            $serv_anter = $movil_anterior[0]->codi_servi;
        }

        $servicio['codi_servi'] = $codi_servi;
        $servicio['codi_circu'] = $codi_circu;
        $servicio['docu_empre'] = $docu_empre;
        $servicio['docu_perso'] = $docu_perso;
        $servicio['nume_movil'] = $nume_movil;
        $servicio['pate_movil'] = $pate_movil;
        $servicio['codi_equip'] = $codi_equip;
        $servicio['inic_servi'] = $inic_servi;
        $servicio['term_servi'] = $term_servi;
        $servicio['habilitado'] = true;
        $servicio['user_modif'] = \Auth::user()->docu_perso;
        $servicio['serv_anter'] = $serv_anter;
        return $servicio;
    }

    private function _maquinaAnterior()
    {
        $consulta = 'SELECT ' .
            'ser.inic_servi, ser.nume_movil, ser.codi_servi, ser.serv_anter ' .
            'FROM db_servicios.tb_servicios ser ' .
            'WHERE ' .
            'ser.codi_circu = ? ' .
            'AND ser.codi_servi < ? ' .
            'ORDER BY ser.inic_servi DESC ' .
            'LIMIT 1;';

        return $consulta;
    }

    private function _definirProgramadas($codi_circu, $codi_servi, $nume_movil, $pate_movil, $fech_servi, $docu_empre)
    {
        $listado = ViewListarPuntosControl::_listar($codi_circu, $docu_empre);

        $programadas = [];
        $minutos = 0;
        foreach ($listado['controles'] as $controles) {
            $inic_servi = Carbon::createFromTimeString($fech_servi)->toDateTimeString();

            $item['inic_servi'] = $inic_servi;
            $inic_exped = null;
            $term_exped = null;
            $item['codi_senti'] = $controles['codi_senti'];
            $item['programadas'] = [];
            foreach ($controles['controles'] as $control) {
                $minutos = $minutos + $control['minu_contr'];
                $fech_progr = Carbon::createFromTimeString($fech_servi)->addMinutes($minutos)->toDateTimeString();

                if ($inic_exped === null) {
                    $inic_exped = $fech_progr;
                }
                $term_exped = $fech_progr;
                $programada = [
                    'codi_servi'    => $codi_servi,
                    'codi_circu'    => $codi_circu,
                    'nume_movil'     => $nume_movil,
                    'codi_senti'    => $controles['codi_senti'],
                    'codi_geoce'    => $control['codi_geoce'],
                    'nomb_geoce'    => $control['nomb_geoce'],
                    'abre_geoce'    => $control['abre_geoce'],
                    'fech_progr'    => Carbon::createFromTimeString($fech_progr)->toDateTimeString(),
                    'minu_toler'    => $control['minu_toler'],
                    'codi_ruta'     => $control['codi_ruta'],
                    'angulo'        => $control['angulo']
                ];
                array_push($item['programadas'], $programada);
                unset($fech_progr, $programada);
            }
            $item['inic_exped'] = $inic_exped;
            $item['term_exped'] = $term_exped;


            $item['term_servi'] = $term_exped;
            array_push($programadas, $item);
        }
        return $programadas;
    }

    private function _definirExpediciones($programadas, $codi_circu, $codi_servi, $nume_movil, $pate_movil, $docu_perso, $docu_empre)
    {
        $expediciones = [];
        $item = null;
        foreach ($programadas as $obj) {
            $item['codi_senti'] = $obj['codi_senti'];
            $item['codi_servi'] = $codi_servi;
            $item['codi_circu'] = $codi_circu;
            $item['nume_movil'] = $nume_movil;
            $item['pate_movil'] = $pate_movil;
            $item['inic_exped'] = $obj["inic_exped"];
            $item['term_exped'] = $obj["term_exped"];
            $item['docu_perso'] = $docu_perso;
            $item['docu_empre'] = $docu_empre;
            array_push($expediciones, $item);
        }
        return $expediciones;
    }
    /*--------------------------------------------------------------------------------------*/
    public function _existeServicio($docu_empre, $codi_servi, $codi_circu)
    {
        $existe = false;
        $servicio = Servicio::where('docu_empre', $docu_empre)
            ->where('codi_servi', $codi_servi)
            ->where('codi_circu', $codi_circu)
            ->limit(1)
            ->get();

        if ($servicio->count() > 0) {
            $existe = true;
        }
        return $existe;
    }

    private function _serviciosPendientes($docu_empre, $codi_circu, $nume_movil, $pate_movil, $fech_servi)
    {
        $pendientes = false;
        $desde = strtotime('+0 day', strtotime($fech_servi));
        $hasta = strtotime('+1 day', strtotime($fech_servi));
        $desde = date('Y-m-d H:i:s', $desde);
        $hasta = date('Y-m-d H:i:s', $hasta);

        $servicio = Servicio::where('docu_empre', $docu_empre)
            ->where('codi_circu', $codi_circu)
            ->where('nume_movil', $nume_movil)
            ->where('pate_movil', $pate_movil)
            ->whereBetween('inic_servi', [$desde, $hasta])
            ->where('finalizado', 0)
            ->limit(1)
            ->get();

        if ($servicio->count() > 0) {
            $pendientes = true;
        }
        return $pendientes;
    }
    /*--------------------------------------------------------------------------------------*/
    private function _actualizarMovil($obj)
    {
        //TODO: DELEGAR AL MODELO "MOVIL"
        try {
            $movil = new Movil($obj);
            Movil::where('nume_movil', $obj['nume_movil'])
                ->where('pate_movil', $obj['pate_movil'])
                ->where('docu_empre', $obj['docu_empre'])
                ->update($movil->toArray());
        } catch (\Exception $e) {
            return response('No se Encontro Programada...!!!', 500);
        }
    }
    /*--------------------------------------------------------------------------------------*/
    private function _imprimirServicio($docu_empre, $codi_circu, $codi_servi, $fech_servi)
    {
        /*
		$desde = $this->_desde($fech_servi);
        $hasta = $this->_hasta($fech_servi);

        $analizar = $this->_listarServiciosXAnalizar2($docu_empre, $codi_circu, $desde, $hasta, 'ASC'); 
        if($analizar->count() > 0){
            event(new \App\Events\Servicios\Iniciados($analizar)); 
        }
        sleep(2);
        */
        $servicio = ViewServicios::_buscar($docu_empre, $codi_circu, $codi_servi);

        if ($servicio['total'] > 0) {
            $tu_servicio = null;
            $mi_servicio = $servicio;
            if ($servicio['servicio']['serv_anter'] !== null) {
                $servicio = ViewServicios::_buscar($docu_empre, $codi_circu, $servicio['servicio']['serv_anter']);
                $tu_servicio = $servicio;
            }

            $servicio_impreso = new ImprimirServicio;
            $servicio_impreso->imprimir($mi_servicio, $tu_servicio);
        }
    }


    /*--------------------------------------------------------------------------------------*/
    private function _listarServiciosXAnalizar2($e, $c, $d, $h, $o)
    {
        $listado = Servicio::where('docu_empre', $e)
            ->where('codi_circu', $c)
            ->whereBetween('inic_servi', [$d, $h])
            ->orderBy('inic_servi', $o)
            ->get();

        return $listado;
    }

    private function _desde($fecha)
    {
        $desde = strtotime('+0 day', strtotime($fecha));
        $desde = date('Y-m-d H:i:s', $desde);
        return $desde;
    }

    private function _hasta($fecha)
    {
        $hasta = strtotime('+1 day', strtotime($fecha));
        $hasta = date('Y-m-d H:i:s', $hasta);
        return $hasta;
    }
}
