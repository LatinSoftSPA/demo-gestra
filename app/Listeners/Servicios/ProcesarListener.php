<?php

namespace App\Listeners\Servicios;

use App\Events\Servicios\Procesar;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Carbon;

use App\Modelos\Servicio;

class ProcesarListener
{
    public function __construct()
    {
        //
    }

    public function handle(Procesar $event)
    {
        $servicios = $event->servicios;
        $this->_procesarServicios($servicios->toArray());

    }


    private function _procesarServicios($servicios)
    {
        foreach ($servicios as $servicio) {
            if($servicio['procesar']){
                if(Carbon::now()->getTimestamp() > $servicio['term_servi']){
                    $servicio['procesar'] = false;
                }
            }
            Servicio::where('codi_servi', $servicio['codi_servi'])
                    ->where('codi_circu', $servicio['codi_circu'])
                    ->where('nume_movil', $servicio['nume_movil'])
                    ->where('codi_equip', $servicio['codi_equip'])
                    ->update(
                     [
                        'procesar'      => $servicio['procesar']
                    ]);
        }
        

    }
}
