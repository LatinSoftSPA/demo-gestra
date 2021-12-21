<?php

namespace App\Listeners\Servicios;

use App\Events\Servicios\Imprimir;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Carbon;


class ImprimirListener
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
    public function handle(Imprimir $event)
    {
        $servicio = $event->servicio;
        $conductor = $event->conductor;
        $movil = $event->movil;
        $programadas = $event->programadas;
        $this->_imrpimirServicio($servicio, $programadas, $conductor, $movil);

    }


    private function _imrpimirServicio($servicio, $programadas, $conductor, $movil)
    {
        $imprimire = new \App\Http\Controllers\Imprimir\ServiciosController;
        $imprimire->imprimirNEW($servicio, $programadas);

    }
}
