<?php

namespace App\Http\Responsables\Gestion\Servicios;

use Illuminate\Contracts\Support\Responsable;

use App\Modelos\DBServicios\Servicio;

//use App\Modelos\DBGestra\Movil;

use App\Modelos\DBServicios\Multa;
use App\Modelos\DBServicios\Pago;

use App\Http\Controllers\Imprimir\PagosController;

class CobrarMulta implements Responsable
{
    protected $_docu_empre;
    protected $_tipo_pago = 1;

    protected $_codi_circu;
    protected $_nume_movil;
    protected $_pate_movil;
    protected $_codi_equip;
    protected $_docu_condu;
    protected $_codi_licen;
    protected $_fecha_hora;

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
    }

    public function toResponse($request)
    {
        $servicio = $request->servicio;
        $expediciones = $request->expediciones;
        $multas = $request->multas;
        $nota_pago = $request->nota;

        \DB::beginTransaction();
        try {
            $pago_total = 0;
            $desc_total = 0;
            foreach ($multas as $multa) {
                Multa::where('codi_servi', $multa['codi_servi'])
                    ->where('codi_circu', $multa['codi_circu'])
                    ->where('nume_movil', $multa['nume_movil'])
                    ->where('codi_senti', $multa['codi_senti'])
                    ->update(
                        [
                            'fech_pagad'    => date('Y-m-d H:i:s'),
                            'tota_pagad'    => $multa['tota_pagad'],
                            'pagada'        => true,
                            'user_modif'    => \Auth::user()->docu_perso
                        ]
                    );
                $pago_total += $multa['tota_pagad'];
                $desc_total += $multa['tota_multa'] - $multa['tota_pagad'];
            }
            Pago::_crear(
                $servicio['codi_servi'],
                $servicio['codi_circu'],
                $servicio['nume_movil'],
                $this->_tipo_pago,
                strtoupper($nota_pago),
                $pago_total,
                $desc_total,
                \Auth::user()->docu_perso
            );

            Servicio::where('codi_servi', $servicio['codi_servi'])
                ->where('codi_circu', $servicio['codi_circu'])
                ->where('nume_movil', $servicio['nume_movil'])
                ->where('pate_movil', $servicio['pate_movil'])
                ->where('codi_equip', $servicio['codi_equip'])
                ->update(
                    [
                        'multado'    => false
                    ]
                );

            $mensaje = 'Se Concreto Correctamente el Pago de su Multa.';
            return response()->json([
                'msg' => $mensaje
            ], 200);

            /**/
        } catch (\Exception $e) {
            \DB::rollback();
            return response('Algo salio mal...!!!', 500);
        } finally {
            $boleta_pagar = new PagosController;
            $boleta_pagar->imprimir($servicio, $multas, $nota_pago);
            $boleta_pagar->imprimirVouche($servicio, $multas, $nota_pago);
        }
        \DB::commit();
    }
}
