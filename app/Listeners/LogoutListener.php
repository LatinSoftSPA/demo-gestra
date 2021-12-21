<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Logout;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;


use App\Modelos\Session;

class LogoutListener
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
    public function handle(Logout $event)
    {
        $user = $event->user;
        $user->last_logout = date("Y-m-d H:i:s");
        $user->activo = true;
        $user->online = false;
        $user->save();

        Session::where('docu_perso', $user['docu_perso'])
            //->where('docu_empre', '96711420')
            ->where('fech_inici', $user['last_login'])
            //->where('ip', $session['ip'])
            //->where('token', $user['remember_token'])
            ->update(
            [
                'fech_termi'    => date("Y-m-d H:i:s")
            ]);
    }
}
