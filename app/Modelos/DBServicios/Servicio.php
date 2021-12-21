<?php

namespace App\Modelos\DBServicios;

use App\Modelos\DBServicios\Configuracion;

class Servicio extends Configuracion
{
    protected $table = 'tb_servicios';
    protected $primaryKey = 'codi_servi';
    protected $fillable = [
        'codi_servi', 'codi_circu', 'docu_empre', 'docu_perso', 'pate_movil', 'codi_equip',
        'inic_servi', 'term_servi', 'nume_movil',
        'iniciado', 'finalizado', 'habilitado', 'procesar',  'serv_anter',
        'multado', 'tota_pagar', 'tota_pagad', 'user_modif'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public static function _crear($servicio)
    {
        try {
            $obj = new Servicio($servicio);
            Servicio::create($obj->toArray());
        } catch (\Exception $e) {
            \DB::rollback();
            return response('Algo salio mal al Crear El Servicio...!!!', 500);
        }
    }

    public static function buscar(Request $request)
    {
        $codi_servi = $request->codi_servi;
        $codi_circu = $request->codi_circu;

        $mi_servicio = Servicio::buscar($codi_servi, $codi_circu);
        return $mi_servicio;
    }
}
