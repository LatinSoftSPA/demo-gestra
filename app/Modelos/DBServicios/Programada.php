<?php

namespace App\Modelos\DBServicios;

use App\Modelos\DBServicios\Configuracion as Model;

//-----------------------------------
use Carbon\Carbon;

class Programada extends Model
{
    protected $table = 'tb_programadas';
    protected $primaryKey = 'codi_servi';
    protected $relations = ['tb_servicios'];
    protected $fillable = [
        'codi_servi', 'codi_circu', 'nume_movil', 'codi_ruta', 'codi_senti', 'codi_geoce',
        'fech_progr', 'fech_contr', 'minu_toler', 'dife_contro', 'tota_multa',
        'latitud', 'longitud', 'angulo', 'velo_contr', 'procesado', 'multado'
    ];

    public static function _crear($programada)
    {
        try {
            $obj = new Programada($programada);
            Programada::create($obj->toArray());
        } catch (\Exception $e) {
            \DB::rollback();
            return response('Algo salio mal al Crear Las Programadas...!!!', 500);
        }
    }

    public static function _actualizarProgramada($codi_servi, $codi_circu, $codi_senti, $codi_geoce, $fech_contr, $latitud, $longitud, $angulo, $velo_contr, $dife_contro, $tota_multa, $multado)
    {
        $programada = Programada::where('codi_servi', $codi_servi)
        ->where('codi_circu', $codi_circu)
        ->where('codi_senti', $codi_senti)
        ->where('codi_geoce', $codi_geoce)
        ->where('procesado', false);
        $programada->update([
            'fech_contr' => $fech_contr,
            'latitud'    => $latitud,
            'longitud'   => $longitud,
            'angulo' => $angulo,
            'velo_contr' => $velo_contr,
            'dife_contro' => $dife_contro,
            'tota_multa' => $tota_multa,
            'multado'    => $multado,
            'procesado'  => true
        ]);
    }

    public static function _actualizarListadoProgramadas($listado)
    {
        \DB::beginTransaction();
        try 
        {
            foreach ($listado as $marcada)
            {                
                $codi_servi = $marcada['codi_servi'];
                $codi_circu = $marcada['codi_circu'];
                $codi_senti = $marcada['codi_senti'];
                $codi_geoce = $marcada['codi_geoce'];
                $fech_contr = $marcada['fech_contr'];
                $latitud = $marcada['lati_marca'];
                $longitud = $marcada['long_marca'];
                $angulo = $marcada['angulo'];
                $velo_contr = $marcada['velo_contr'];
                $dife_contro = $marcada['dife_contro'];
                $tota_multa = $marcada['tota_multa'];
                $multado = $marcada['multado'];
                //print_r([$codi_servi, $codi_circu, $codi_senti, $codi_geoce, $fech_contr, $latitud, $longitud, $angulo, $velo_contr, $dife_contro, $tota_multa, $multado]);
                Programada::_actualizarProgramada($codi_servi, $codi_circu, $codi_senti, $codi_geoce, $fech_contr, $latitud, $longitud, $angulo, $velo_contr, $dife_contro, $tota_multa, $multado);
            }
        } catch (\Exception $e) {
            \DB::rollback();
            return response('Algo salio mal...!!!', 500);
        }
        \DB::commit();
    }
}
