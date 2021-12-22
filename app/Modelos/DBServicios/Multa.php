<?php

namespace App\Modelos\DBServicios;

use App\Modelos\DBServicios\Configuracion;

class Multa extends Configuracion
{
    protected $table = 'tb_multas';
    protected $primaryKey = 'codi_servi';

    protected $fillable = [
        'docu_empre',
        'codi_servi', 'codi_circu', 'nume_movil', 'codi_senti',
        'tota_multa', 'fech_multa', 'tota_pagad', 'fech_pagad',
        'pagada', 'user_modif'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public static function _buscar($docu_empre, $codi_circu, $codi_servi, $codi_senti)
    {
        try {
            $multa = Multa::where('docu_empre', $docu_empre)
                ->where('codi_circu', $codi_circu)
                ->where('codi_servi', $codi_servi)
                ->where('codi_senti', $codi_senti)
                ->get();
            return $multa;
        } catch (\Exception $e) {
            return response('Problemas al tratar de Buscar: Multa', 500);
        }
    }

    public static function _crear($multa)
    {
        try {
            Multa::create($multa);
        } catch (\Exception $e) {
            return response('Problemas al tratar de Crear: Multa', 500);
        }
    }

    private function _crear2($docu_empre, $codi_servi, $codi_circu, $nume_movil, $codi_senti, $tota_multa, $fech_multa, $user_modif)
    {
        try {
            Multa::create([
                'docu_empre' => $docu_empre,
                'codi_servi' => $codi_servi,
                'codi_circu' => $codi_circu,
                'nume_movil' => $nume_movil,
                'codi_senti' => $codi_senti,
                'tota_multa' => $tota_multa,
                'fech_multa' => $fech_multa,
                'user_modif' => $user_modif
            ]);
        } catch (\Exception $e) {
            return response('Problemas al tratar de Crear: Multa', 500);
        }
    }


    public static function definirMulta($docu_empre, $codi_servi, $codi_circu, $nume_movil, $codi_senti, $tota_multa, $fech_multa, $user_modif)
    {
        $multa['docu_empre'] = $docu_empre;
        $multa['codi_servi'] = $codi_servi;
        $multa['codi_circu'] = $codi_circu;
        $multa['nume_movil'] = $nume_movil;
        $multa['codi_senti'] = $codi_senti;
        $multa['tota_multa'] = $tota_multa;
        $multa['fech_multa'] = $fech_multa;
        $multa['user_modif'] = $user_modif;

        print_r([$docu_empre, $codi_servi, $codi_circu, $nume_movil, $codi_senti, $tota_multa, $fech_multa, $user_modif]);
        // Multa::_crear($multa);
    }
}
