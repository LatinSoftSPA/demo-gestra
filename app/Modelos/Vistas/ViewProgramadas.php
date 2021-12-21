<?php

namespace App\Modelos\Vistas;

use Illuminate\Database\Eloquent\Model;

class ViewProgramadas extends Model
{
	protected $connection = 'db_servicios';	
    protected $table = 'viewProgramadas';

	public static function _listar($s, $c, $e, $g)
	{
		try
        {
            $listado = ViewProgramadas::
                where('codi_servi', $s)
                ->where('codi_circu', $c)
                ->where('codi_senti', $e)
                ->where('codi_geoce', $g)
                ->where('procesado', 0)
                ->get();
            return $listado;
        } catch (\Exception $e){
            return response('No se Encontro Programada...!!!', 500);
        }
	}
}