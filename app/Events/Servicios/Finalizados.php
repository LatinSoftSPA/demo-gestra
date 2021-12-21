<?php

namespace App\Events\Servicios;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;

use App\Modelos\Vistas\ViewListarServicios;

class Finalizados
{
    use Dispatchable, SerializesModels;

    public $servicios;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($servicios)
    {
        $this->servicios = $servicios;
    }
}
