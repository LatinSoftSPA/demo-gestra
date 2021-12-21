<?php

namespace App\Modelos\Vistas;

use Illuminate\Database\Eloquent\Model;

class ViewArribos extends Model
{
	protected $connection = 'db_gts';	
    protected $table = 'viewArribos';

    public static function _listar($e, $d, $h)
	{
		try
        {
            $listado = ViewArribos::where('deviceID', $e)
	                ->whereBetween('timestamp', [$d, $h])
	                ->orderBy('timestamp', 'asc')
	                ->groupBy('geozoneID')
	                ->get();

            return $listado;
        } catch (\Exception $e){
            return response('No se Encontro Marcadas...!!!', 500);
        }
	}
}