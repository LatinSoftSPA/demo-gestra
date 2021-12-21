<?php

namespace App\Http\Controllers\Gestra;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
//-----------------------------------
use App\Modelos\DBServicios\Servicio;
use App\Modelos\DBServicios\Multa;
use App\Modelos\DBServicios\Programada;
use App\Modelos\DBServicios\Expedicion;
use App\Modelos\DBGestra\Movil;

use App\Modelos\Vistas\ViewArribos;

use App\Modelos\DBServicios\ViewListarServicios;
use App\Modelos\DBServicios\ViewListarProgramadas;
use App\Modelos\DBServicios\ViewListarPuntosControl;

use App\Http\Controllers\Imprimir\ServiciosController as ImprimirServicio;
use App\Http\Controllers\Gestion\ProgramadasController;
//-----------------------------------
use Carbon\Carbon;

class ServiciosController extends Controller
{
    public function guardar(Request $request)
    {
        $docu_empre = $this->_docu_empre;
        $codi_circu = $request['codi_circu'];
        $nume_movil = $request['nume_movil'];
        $pate_movil = $request['pate_movil'];
        //$fech_revis = $request['fech_revis'];
        $codi_equip = $request['codi_equip'];
        $docu_condu = $request['docu_condu'];
        $codi_licen = $request['codi_licen'];
        $fecha_hora = $request['fecha'] . ' ' . $request['hora'];
        $fech_servi = Carbon::createFromTimeString($fecha_hora)->toDateTimeString();

        //$codi_servi = strtotime('-3', strtotime($fech_servi));
        $codi_servi = Carbon::createFromTimeString($fecha_hora)->timestamp;
        $imprimir = $request->imprimir;

        if ($this->_serviciosPendientes($codi_circu, $nume_movil, $pate_movil, $fech_servi)) {
            $mensaje = 'Este Movil tiene Servicios Pendientes.';
            return response()->json([
                'msg' => $mensaje
            ], 500);
        }
        if ($this->_existeServicio($codi_servi, $codi_circu) === false) {
            $objeto = $this->_definir($codi_circu, $codi_servi, $nume_movil, $pate_movil, $codi_equip, $docu_condu, $codi_licen, $docu_empre, $fech_servi);
            \DB::beginTransaction();
            try {
                Servicio::_crear($objeto['servicio']);

                foreach ($objeto['controles'] as $controles) {
                    foreach ($controles['programadas'] as $programada) {
                        Programada::_crear($programada);
                    }
                }
                foreach ($objeto['expediciones'] as $expedicion) {
                    Expedicion::_crear($expedicion);
                }
                Movil::_actualizar($objeto['movil']);
                $mensaje = 'Servicio Registrado Correctamente.';
                return response()->json([
                    'msg' => $mensaje
                ], 200);
            } catch (\Exception $e) {
                \DB::rollback();
                return response('Algo salio mal...!!!', 500);
            } finally {
                if ($imprimir === "true") {
                    $servicio_impreso = new ImprimirServicio;
                    $obj = $this->_buscar($codi_servi, $codi_circu);
                    $servicio_impreso->imprimirNEW($obj);
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

    private function _definir($codi_circu, $codi_servi, $nume_movil, $pate_movil, $codi_equip, $docu_condu, $codi_licen, $docu_empre, $fech_servi)
    {
        $programadas = $this->_definirProgramadas($codi_circu, $codi_servi, $nume_movil, $pate_movil, $fech_servi, $docu_empre);
        $expediciones = $this->_definirExpediciones($programadas, $codi_circu, $codi_servi, $nume_movil, $pate_movil, $docu_condu, $docu_empre);
        foreach ($programadas as $programada) {
            $inic_servi = $programada['inic_servi'];
            $term_servi = $programada['term_servi'];
        }
        $servicio = $this->_definirServicio($codi_servi, $codi_circu, $docu_empre, $docu_condu, $nume_movil, $pate_movil, $codi_equip, $inic_servi, $term_servi);

        $movil = $this->_definirMovil($nume_movil, $pate_movil, $codi_equip, $docu_empre, $codi_licen, $codi_servi);
        return [
            'servicio'      => $servicio,
            'controles'     => $programadas,
            'expediciones'  => $expediciones,
            'movil'         => $movil
        ];
    }

    private function _definirMovil($nume_movil, $pate_movil, $codi_equip, $docu_empre, $docu_condu, $codi_servi)
    {
        $movil['nume_movil'] = $nume_movil;
        $movil['pate_movil'] = $pate_movil;
        $movil['docu_empre'] = $docu_empre;
        $movil['docu_condu'] = $docu_condu;
        $movil['codi_equip'] = $codi_equip;
        $movil['ulti_servi'] = $codi_servi;
        return $movil;
    }

    private function _definirServicio($codi_servi, $codi_circu, $docu_empre, $docu_perso, $nume_movil, $pate_movil, $codi_equip, $inic_servi, $term_servi)
    {
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
        return $servicio;
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
            $codi_senti =
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
    private function _existeServicio($codi_servi, $codi_circu)
    {
        try {
            $servicio = Servicio::where('codi_servi', $codi_servi)
                ->where('codi_circu', $codi_circu)
                ->limit(1)
                ->get();

            $existe = false;
            if ($servicio->count() > 0) {
                $existe = true;
            }
            return $existe;
        } catch (\Exception $e) {
            return response('Algo salio mal...!!!', 500);
        }
    }

    private function _serviciosPendientes($codi_circu, $nume_movil, $pate_movil, $fech_servi)
    {
        $pendientes = false;
        $desde = strtotime('+0 day', strtotime($fech_servi));
        $hasta = strtotime('+1 day', strtotime($fech_servi));
        $desde = date('Y-m-d H:i:s', $desde);
        $hasta = date('Y-m-d H:i:s', $hasta);


        $servicio = Servicio::where('codi_circu', $codi_circu)
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

    public function listarServiciosProcesar(Request $request)
    {
        if ($request->ajax()) {
            $codi_circu = $request->codi_circu;
            $fech_servi = $request->fech_servi;
            $docu_empre = $this->_docu_empre;
            try {
                $desde = strtotime('+0 day', strtotime($fech_servi));
                $hasta = strtotime('+1 day', strtotime($fech_servi));

                $desde = date('Y-m-d H:i:s', $desde);
                $hasta = date('Y-m-d H:i:s', $hasta);
                $lst =  ViewListarServicios::where('codi_circu', $codi_circu)
                    ->where('docu_empre', $docu_empre)
                    ->whereBetween('inic_servi', [$desde, $hasta])
                    ->where('procesar', true)
                    ->orderBy('inic_servi', 'ASC')
                    ->get();
                if ($lst->count() > 0) {
                    $mensaje = 'Hay: ' . $lst->count() . ' Servicios para Procesar.';
                    return response()->json([
                        'servicios'     => $lst->toArray(),
                        'total'         => $lst->count(),
                        'msg'           => $mensaje
                    ], 200);
                } else {
                    return response('No se Encontraron Servicios para Procesar.', 404);
                }
            } catch (\Exception $e) {
                return response('Algo salio mal...!!!', 500);
            }
        }
    }

    public function procesarServicio(Request $request)
    {
        var_dump($request);
        if ($request->ajax()) {
        }

        $codi_servi = $request->codi_servi;
        $codi_circu = $request->codi_circu;
        $nume_movil = $request->nume_movil;
        $pate_movil = $request->pate_movil;
        //$codi_equip = $request->codi_equip;
        $servicio = $this->_buscar($codi_servi, $codi_circu);
        $mi_servicio = $servicio['mi_servicio'];
        $expediciones = $mi_servicio['expediciones'];
        $listado = [];
        foreach ($expediciones as $expedicion) {
            $desde = strtotime('-10 minutes', strtotime($expedicion['inic_exped']));
            $hasta = strtotime('+40 minutes', strtotime($expedicion['term_exped']));

            $arribos = ViewArribos::_listar($expedicion['codi_equip'], $desde, $hasta);
            $listado[$expedicion['codi_senti']] =
                [
                    'sentido' => $expedicion['codi_senti'],
                    'marcadas' => $arribos->toArray()
                ];
        }
        foreach ($listado as $lista) {
            $sentido = $lista['sentido'];
            $marcadas = $lista['marcadas'];
            $this->_actualizaProgramadas($codi_servi, $codi_circu, $nume_movil, $pate_movil, $sentido, $marcadas);
        }
        //IMPRIMIR INFORME DEL SERVICIO

    }

    private function _actualizaProgramadas($codi_servi, $codi_circu, $nume_movil, $pate_movil, $codi_senti, $marcadas)
    {
        $programadas = new ProgramadasController;
        $programadas->procesarProgramadas($codi_servi, $codi_circu, $nume_movil, $pate_movil, $codi_senti, $marcadas);
    }

    /*--------------------------------------------------------------------------------------*/
    public function listar(Request $request)
    {
        $codi_circu = $request->codi_circu;
        $docu_empre = $this->_docu_empre;
        $desde = strtotime('+0 day', strtotime($request->fech_servi));
        $hasta = strtotime('+1 day', strtotime($request->fech_servi));
        try {
            $listado = ViewListarServicios::listar($codi_circu, $docu_empre, $desde, $hasta, 'DESC');
            if ($listado->count() > 0) {
                //TODO: "PROCESAR" SERVICIOS FINALIZADOS
                $analizados = $this->_analizarServicios($codi_circu, $docu_empre, $desde, $hasta);
                $this->_procesar($analizados['finalizados']);
                //
                $mensaje = 'Se encontraron ' . $listado->count() . ' Servicios.';
                return response()->json([
                    'listado'       => $listado,
                    'finalizados'   => $analizados['finalizados'],
                    'total'         => $listado->count(),
                    'msg'           => $mensaje
                ], 200);
            } else {
                return response('No se Encontraron Servicios para el "Dia" Seleccionado.', 404);
            }
        } catch (\Exception $e) {
            return response('Algo salio mal...!!!', 500);
        }
    }

    public function filtrar(Request $request)
    {
        $nume_movil = $request->nume_movil;
        $codi_circu = $request->codi_circu;
        $docu_empre = $this->_docu_empre;

        $desde = strtotime('+0 day', strtotime($request->fech_servi));
        $hasta = strtotime('+1 day', strtotime($request->fech_servi));
        try {
            $listado = ViewListarServicios::filtrar($nume_movil, $codi_circu, $docu_empre, $desde, $hasta, 'DESC');

            if ($listado->count() > 0) {
                $mensaje = 'Se encontraron ' . $listado->count() . ' Servicios.';
                return response()->json([
                    'listado'   => $listado,
                    'total'     => $listado->count(),
                    'msg'       => $mensaje

                ], 200);
            } else {
                return response('No se Encontraron Servicios para el "Movil" Seleccionado.', 404);
            }
        } catch (\Exception $e) {
            return response('Algo salio mal...!!!', 500);
        }
    }

    public function show(Request $request)
    {
        //if($request->ajax()){}
        $codi_servi = $request->codi_servi;
        $codi_circu = $request->codi_circu;
        try {
            $servicio = $this->_buscar($codi_servi, $codi_circu);
            return response()->json($servicio, 200);
        } catch (\Exception $e) {
            return response('Algo salio mal...!!!', 500);
        }
    }

    private function _buscar($codi_servi, $codi_circu)
    {
        $mi_servicio = ViewListarServicios::servicio($codi_servi, $codi_circu);
        $tu_servicio = null;
        if ($mi_servicio['servicio']['serv_anter'] !== null) {
            $tu_servicio = ViewListarServicios::servicio($mi_servicio['servicio']['serv_anter'], $codi_circu);
        }
        $objeto = [
            'mi_servicio'   => $mi_servicio,
            'tu_servicio'   => $tu_servicio
        ];
        return $objeto;
    }

    private function _analizarServicios($codi_circu, $docu_empre, $desde, $hasta)
    {
        $listado = ViewListarServicios::listar($codi_circu, $docu_empre, $desde, $hasta, 'ASC');
        $analizados = event(new \App\Events\Servicios\Analizar($listado));
        return $analizados[0];
    }


    public function imprimir(Request $request)
    {
        $codi_servi = $request->codi_servi;
        $codi_circu = $request->codi_circu;

        $servicio_impreso = new ImprimirServicio;
        $obj = $this->_buscar($codi_servi, $codi_circu);
        $servicio_impreso->imprimirNEW($obj);
    }
}
