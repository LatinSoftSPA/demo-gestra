<?php

namespace App\Events\Servicios;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;


class Imprimir
{
    use Dispatchable, SerializesModels;

    public $servicio;
    public $conductor;
    public $movil;
    public $programadas;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($servicio, $programadas, $conductor, $movil)
    {
        $this->servicio = $servicio;
        $this->conductor = $conductor;
        $this->movil = $movil;
        $this->programadas = $programadas;
    }
}
