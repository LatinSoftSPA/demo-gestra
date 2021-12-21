<?php

namespace App\Modelos\DBGestra;

use App\Modelos\DBGestra\Configuracion as Model;

class Licencia extends Model
{	
    protected $table = 'tb_licencias';
	protected $primaryKey = 'docu_perso';
	protected $relations = ['tb_conductores'];
	protected $fillable = ['docu_perso', 'codi_licen', 'A1', 'A2', 'A3', 'A4', 'A5', 'B', 'C', 'D', 'E', 'F', 'fech_venci', 'user_modif'];
	protected $casts = ['A1' => 'boolean', 'A2' => 'boolean', 'A3' => 'boolean', 'A4' => 'boolean', 'A5' => 'boolean', 'B' => 'boolean', 'C' => 'boolean', 'D' => 'boolean', 'E' => 'boolean', 'F' => 'boolean'];

	public static function _buscar($docu_perso)
	{
		try
		{
			return Licencia::where('docu_perso', $docu_perso)->get();
		} catch (\Exception $e){
            \DB::rollback();
            return response('Error en el Servidor...!!!', 500);
        }
	}

	public static function _eliminar($docu_perso)
	{		
		try
		{
			Licencia::where('docu_perso', $docu_perso)->delete();
		} catch (\Exception $e){
            \DB::rollback();
            return response('Error en el Servidor...!!!', 500);
        }
	}
	/*	RELACIONES	*/
	public function conductor(){
		return $this->belongsTo('App\Modelos\Conductor');
	}    
}
