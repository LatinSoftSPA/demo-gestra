<?php

namespace App\Modelos\DBGestra;

use App\Modelos\DBGestra\Configuracion as Model;

class Conductor extends Model
{	
    protected $table = 'tb_conductores';
	protected $primaryKey = 'docu_perso';
	protected $relations = ['tb_personas', 'tb_empresas', 'tb_licencias'];
	protected $fillable = ['docu_perso', 'docu_empre', 'habilitado'];

	public static function _buscar($docu_perso)
	{
		try
		{
			return Conductor::where('docu_perso', $docu_perso)->get();
		} catch (\Exception $e){
            return response('Error en el Servidor...!!!', 500);
        }
	}

	public static function _eliminar($docu_perso)
	{
		try
		{
			Conductor::where('docu_perso', $docu_perso)->delete();
		} catch (\Exception $e){
            return response('Error en el Servidor...!!!', 500);
        }
	}
	/*	RELACIONES	*/
	public function persona()
	{
		return $this->belongsTo('App\Modelos\Persona');
	}

	public function licencia()
	{
		return $this->belongsTo('App\Modelos\Licencia');
	}
    
}
