<?php

namespace App\Modelos\Vistas;

use Illuminate\Database\Eloquent\Model;

use App\Modelos\Vistas\ViewListarProgramadas;

use App\Modelos\Programada;
use App\Modelos\Expedicion;
use App\Modelos\Multa;

class ViewServicios extends Model
{
	protected $connection = 'db_servicios';	
    protected $table = 'viewServicios';

    protected $fillable = [
        'codi_servi', 'codi_circu', 'inic_servi', 'term_servi',
        'docu_empre', 'docu_perso', 'nume_movil', 'pate_movil', 
        'codi_equip', 'fech_revis', 
        'iniciado', 'finalizado', 'habilitado', 'procesar', 'serv_anter',   
        'multado', 'tota_pagar', 'tota_pagad'
        ,'dia'
    ];

    
    public static function _listar($c, $e, $d, $h)
	{
		try
        {
            $listado = ViewServicios::where('codi_circu', $c)
                    ->where('docu_empre', $e)
                    ->where('procesar', true)
                    ->whereBetween('inic_servi', [$d, $h])
                    ->orderBy('inic_servi', 'ASC')
                    ->get();

            return $listado;
        } catch (\Exception $e){
            return response('No se Encontro Programada...!!!', 500);
        }
	}

    public static function _iniciados($c, $d, $h, $o)
    {
        $docu_empre = 96711420;
        try
        {
            $listado = ViewServicios::where('codi_circu', $c)
                    //->where('docu_empre', $docu_empre)
                    ->where('iniciado', true)
                    ->whereBetween('inic_servi', [$d, $h])
                    ->orderBy('inic_servi', $o)
                    ->limit(10)
                    ->get();

            return $listado;
        } catch (\Exception $e){
            return response('No se Encontro Programada...!!!', 500);
        }
    }

    public static function _finalizados($c, $d, $h, $o)
    {
        $docu_empre = 97611420;
        try
        {
            $listado = ViewServicios::where('codi_circu', $c)
                    //->where('docu_empre', $docu_empre)
                    ->where('finalizado', true)
                    ->whereBetween('inic_servi', [$d, $h])
                    ->orderBy('inic_servi', $o)
                    ->get();

            return $listado;
        } catch (\Exception $e){
            return response('No se Encontro Programada...!!!', 500);
        }
    }

    public static function _finalizarServicios($c, $m, $d, $h, $o)
    {
        try
        {
            $listado = ViewServicios::where('codi_circu', $c)
                    ->where('nume_movil', $m)
                    ->whereBetween('inic_servi', [$d, $h])
                    ->orderBy('inic_servi', $o)
                    ->get();

            return $listado;
        } catch (\Exception $e){
            return response('No se Encontro Programada...!!!', 500);
        }
    }

    public static function _procesarServicio($c, $m, $d, $h, $o)
    {
        //$docu_empre = 97611420;
        try
        {
            $listado = ViewServicios::where('codi_circu', $c)
                    ->where('nume_movil', $m)
                    ->where('procesar', true)
                    ->whereBetween('inic_servi', [$d, $h])
                    ->orderBy('inic_servi', $o)
                    ->get();

            return $listado;
        } catch (\Exception $e){
            return response('No se Encontro Programada...!!!', 500);
        }
    }

    public static function _procesarServicios($c, $d, $h, $o)
    {
        $docu_empre = 97611420;
        try
        {
            $listado = ViewServicios::where('codi_circu', $c)
                    ->where('docu_empre', $docu_empre)
                    ->where('procesar', true)
                    ->whereBetween('inic_servi', [$d, $h])
                    ->orderBy('inic_servi', $o)
                    ->get();

            return $listado;
        } catch (\Exception $e){
            return response('No se Encontro Programada...!!!', 500);
        }
    }
}