<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;


use App\Modelos\Session;

class LoginListener
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
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        //dd($event->session);
        $user = $event->user;
        $user->last_login = date("Y-m-d H:i:s");
        $user->activo = false;
        $user->online = true;
        $user->save();

        Session::create([
                    'docu_perso' => $user['docu_perso'],
                    'docu_empre' => '96711420',
                    'fech_inici' => date("Y-m-d H:i:s"),
                    'ip' => request()->ip(),
                    'token' => $user['remember_token']
                ]);  
    }
}
