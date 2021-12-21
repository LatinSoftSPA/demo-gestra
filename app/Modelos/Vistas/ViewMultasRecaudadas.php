<?php

namespace App\Modelos\Vistas;

use Illuminate\Database\Eloquent\Model;

class ViewMultasRecaudadas extends Model
{
	protected $connection = 'db_servicios';	
    protected $table = 'viewMultasRecaudadas';

    protected $fillable = [];

    public static function _listar($u, $d, $h)
    {
        $d = strtotime('+0 day' , strtotime($d));     //TO TIMESTAMP
        $h = strtotime('+1 day' , strtotime($h));     //TO TIMESTAMP

        $d = date('Y-m-d H:i:s', $d);
        $h = date('Y-m-d H:i:s', $h);
        try
        {
            $listado = ViewMultasRecaudadas::where('user_modif', $u)
                    //->whereDate('fecha', $d)
                    ->whereBetween('fech_multa', [$d, $h])
                    //->orderBy('inic_servi', 'ASC')
                    ->get();

            return $listado;
        } catch (\Exception $e){
            return response('No se Encontro Multas...!!!', 500);
        }
    }
}