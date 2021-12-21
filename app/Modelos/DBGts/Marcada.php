<?php

namespace App\Modelos\DBGts;

use App\Modelos\DBGts\Configuracion as Model;

use Carbon\Carbon;

class Marcada extends Model
{
    protected $table = 'EventData';

    public static function _buscarMarcada($codi_equip, $latitude1, $longitude1, $fech_progr)
    {
        $accountID = 'lineas-cur';
        $desde = Carbon::createFromTimeString($fech_progr)->subMinutes(5)->timestamp;
        $hasta = Carbon::createFromTimeString($fech_progr)->addMinutes(30)->timestamp;
        $radius = 0.3;
        $haversine = '( 6371 * acos( cos( radians(?) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(?) ) + sin( radians(?) ) * sin( radians( latitude ) ) ) ) AS distance';
        $listado = Marcada::select('EventData.*')
            ->where('deviceID', $codi_equip)
            ->where('accountID', $accountID)
            ->whereBetween('timestamp', [$desde, $hasta])
            ->selectRaw($haversine, [$latitude1, $longitude1, $latitude1])
            ->havingRaw('distance < ?', [$radius])
            ->limit(1)
            ->get();

        return $listado->toArray();
    }
}
