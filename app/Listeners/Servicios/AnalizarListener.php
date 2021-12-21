<?php

namespace App\Listeners\Servicios;

use App\Events\Servicios\Analizar;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Carbon;

use App\Modelos\DBServicios\Servicio;

class AnalizarListener
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
    public function handle(Analizar $event)
    {
        $listado = $event->listado;
        return $this->_analizarServicios($listado->toArray());

    }


    private function _analizarServicios($listado)
    {
        //$minutos = 60 * 2;
        $minutos = 60 * 10;
        $servicios_iniciados = [];
        $servicios_finalizados = [];

        $serv_anter = null;
        foreach ($listado as $servicio){
            if($servicio['iniciado'] === 0){
                if(Carbon::now()->getTimestamp() > strtotime($servicio['inic_servi'])){                    
                    $servicio['iniciado'] = 1;
                    $servicio['habilitado'] = 0;
                    array_push($servicios_iniciados, $servicio);                 
                }
            }
            
            if($servicio['finalizado'] === 0){
                if(Carbon::now()->getTimestamp() > (strtotime($servicio['term_servi']) + $minutos))
                {
                    $servicio['finalizado'] = 1;
                    $servicio['procesar'] = 1;
                    array_push($servicios_finalizados, $servicio); 
                }
            }
            
            $this->_actualizarServicioAnalizado($servicio, $serv_anter);
            $serv_anter = $servicio['codi_servi'];
        }
        
        return 
        [
            'iniciados' => $servicios_iniciados, 
            'finalizados' => $servicios_finalizados
        ];
    }

    private function _actualizarServicioAnalizado($servicio, $serv_anter)
    {
        \DB::beginTransaction();
        try
        {
            $obj = new Servicio($servicio);
            $obj['user_modif'] = \Auth::user()->docu_perso;
            $obj['serv_anter'] = $serv_anter;

            Servicio::where('codi_servi', $servicio['codi_servi'])
                    ->where('codi_circu', $servicio['codi_circu'])
                    ->where('nume_movil', $servicio['nume_movil'])
                    ->where('codi_equip', $servicio['codi_equip'])
                    ->update($obj->toArray());
        } catch (\Exception $e){
            \DB::rollback();
            //return response('Algo salio mal...!!!', 500);
        }
        \DB::commit();
    }
}
