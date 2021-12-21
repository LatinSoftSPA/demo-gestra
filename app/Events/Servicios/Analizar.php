<?php

namespace App\Events\Servicios;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;

class Analizar
{
    use Dispatchable, SerializesModels;

    public $listado;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($listado)
    {
        $this->listado = $listado;
    }
}
