<?php

namespace App\Http\Controllers\Gestra;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Modelos\Multa;

use App\Http\Controllers\Imprimir\PagosController;

class MultasController extends Controller
{
    private $_tipo_pago = 1;

    public function pagarMulta(Request $request)
    {
        if($request->ajax())
		{
            $servicio = $request->servicio;
            $expediciones = $request->expediciones;
            $multas = $request->multas;
            $nota_pago = $request->nota;

        	\DB::beginTransaction();
            try
            {
                $pago_total = 0;
                $desc_total = 0;
                foreach($multas as $multa)
                {
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
                            ]);
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
                    ]);

                $mensaje = 'Se Concreto Correctamente el Pago de su Multa.';
                return response()->json([
                    'msg' => $mensaje
                ], 200);
				
				/**/
            } 
			catch (\Exception $e)
			{
                \DB::rollback();
                return response('Algo salio mal...!!!', 500);
            } 
			finally 
			{
				$boleta_pagar = new PagosController;
				$boleta_pagar->imprimir($servicio, $multas, $nota_pago);
				$boleta_pagar->imprimirVouche($servicio, $multas, $nota_pago);
            }
            \DB::commit();
        }
    }

    public function definirMulta()
    {

    }
}