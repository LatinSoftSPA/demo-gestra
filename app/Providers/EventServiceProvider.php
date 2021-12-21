<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'Illuminate\Auth\Events\Login' => [
            'App\Listeners\LoginListener',
        ],
        'Illuminate\Auth\Events\Logout' => [
            'App\Listeners\LogoutListener',
        ],
        //LISTENER DE LOS SERVICIOS
        'App\Events\Servicios\Analizar' => [
            'App\Listeners\Servicios\AnalizarListener',
        ],




        
        'App\Events\Servicios\Iniciados' => [
            'App\Listeners\Servicios\IniciadosListener',
        ],
        'App\Events\Servicios\Finalizados' => [
            'App\Listeners\Servicios\FinalizadosListener',
        ],
        'App\Events\Servicios\Procesar' => [
            'App\Listeners\Servicios\ProcesarListener',
        ],
        //LISTENER PARA IMPRIMIR
        'App\Events\Servicios\Imprimir' => [
            'App\Listeners\Servicios\ImprimirListener',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
