<?php

namespace App\Modelos\DBServicios;

use App\Modelos\DBServicios\Configuracion as Model;

class ViewListarProgramadas extends Model
{
    protected $table = 'viewListarProgramadas';
    protected $fillable = [
        'codi_servi', 'codi_circu', 'codi_ruta', 'codi_senti', 'fech_progr',
        'fech_contr', 'minu_toler', 'dife_contro', 'tota_multa', 'procesado',
        'longitud', 'latitud', 'velo_contr', 'nomb_geoce',
        'abre_geoce', 'codi_geoce', 'posi_contr', 'angulo'
    ];

    public static function listar($codi_circu, $codi_servi)
    {
        $listado = ViewListarProgramadas::where('codi_servi', $codi_servi)
            ->where('codi_circu', $codi_circu)
            ->get();

        return $listado;
    }

    public static function _buscar($s, $c, $e, $g)
    {
        try {
            $programada = ViewListarProgramadas::where('codi_servi', $s)
                ->where('codi_circu', $c)
                ->where('codi_senti', $e)
                ->where('codi_geoce', $g)
                ->limit(1)
                ->get();
            return $programada;
        } catch (\Exception $e) {
            return response('No se Encontro Programada...!!!', 500);
        }
    }
}
