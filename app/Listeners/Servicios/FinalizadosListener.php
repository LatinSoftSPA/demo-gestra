<?php

namespace App\Listeners\Servicios;

use App\Events\Servicios\Finalizados;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Carbon;

use App\Modelos\Servicio;

class FinalizadosListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Logout  $event
     * @return void
     */
    public function handle(Finalizados $event)
    {
        $servicios = $event->servicios;
        $this->_procesarServicios($servicios->toArray());

    }


    private function _procesarServicios($servicios)
    {
        foreach ($servicios as $servicio) {
            if($servicio['finalizado']){
                $servicio['procesar'] = true;
            
                \DB::beginTransaction();
                try{
                    Servicio::where('codi_servi', $servicio['codi_servi'])
                            ->where('codi_circu', $servicio['codi_circu'])
                            ->where('nume_movil', $servicio['nume_movil'])
                            ->where('codi_equip', $servicio['codi_equip'])
                            ->update(
                             [
                                'iniciado'      => $servicio['iniciado'],
                                'finalizado'    => $servicio['finalizado'],
                                'habilitado'    => $servicio['habilitado'],
                                'procesar'      => $servicio['procesar']
                            ]);
                } catch (\Exception $e){
                    \DB::rollback();
                    //return response('Algo salio mal...!!!', 500);
                }
                \DB::commit();
            }
        }
    }
}
