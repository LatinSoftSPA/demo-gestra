<?php

namespace App\Modelos\DBGestra;

use App\Modelos\DBGestra\Configuracion as Model;

class Movil extends Model
{
	protected $table = 'tb_moviles';
	protected $primaryKey = 'nume_movil';
	
	protected $fillable = [
		'nume_movil', 'pate_movil', 'docu_empre', 'docu_perso', 
		'docu_condu', 'codi_licen', 'ulti_servi', 'anio_movil', 
		'fech_revis', 'habilitado', 'codi_equip', 'user_modif'
	];
	
	protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

	public static function _buscar($nume_movil)
	{
		try
		{
			return Movil::where('nume_movil', $nume_movil)->get();
		} catch (\Exception $e){
            \DB::rollback();
            return response('Error en el Servidor...!!!', 500);
        }
	}

	public static function _listarFlota($docu_empre, $docu_perso)
	{
		try
		{
			return Movil::where('docu_perso', $docu_perso)->get();
		} catch (\Exception $e){
            \DB::rollback();
            return response('Error en el Servidor...!!!', 500);
        }
	}

	public static function _eliminar($pate_movil, $nume_movil)
	{
		try
		{
			Movil::where('pate_movil', $pate_movil)->where('nume_movil', $nume_movil)->delete();
		} catch (\Exception $e){
            \DB::rollback();
            return response('Error en el Servidor...!!!', 500);
        }
	}

	public static function _actualizar($obj)
	{
        try
        {
			$movil = new Movil($obj);
			Movil::where('nume_movil', $obj->nume_movil)
	            ->where('pate_movil', $obj->pate_movil)
	            ->where('docu_empre', $obj->docu_empre)
                ->update($movil->toArray());
        } catch (\Exception $e){
            return response('No se Encontro Programada...!!!', 500);
        }
	}
}
