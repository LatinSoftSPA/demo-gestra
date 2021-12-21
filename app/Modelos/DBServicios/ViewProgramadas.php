<?php

namespace App\Modelos\DBServicios;

use App\Modelos\DBServicios\Configuracion;

class ViewProgramadas extends Configuracion
{
    protected $table = 'viewListarProgramadas';
    protected $fillable = [
        'codi_servi', 'codi_circu', 'codi_ruta', 'codi_senti', 'fech_progr', 
        'fech_contr', 'minu_toler', 'dife_contro', 'tota_multa', 'procesado', 
        'longitud', 'latitud', 'velo_contr', 'nomb_geoce', 
        'abre_geoce', 'codi_geoce', 'posi_contr', 'angulo'
    ];


    public static function _listar($codi_circu, $codi_servi)
    {
        try
        {
            $listado = ViewProgramadas::where('codi_circu', $codi_circu)
                ->where('codi_servi', $codi_servi)
                ->get();

            return $listado->toArray();
        } catch (\Exception $e){
            return response('Error de Comunicacion en el Servidor JAJA!!!', 500);
        }
    }
}