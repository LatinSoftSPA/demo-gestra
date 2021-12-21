<?php

namespace App\Modelos\Vistas;

use Illuminate\Database\Eloquent\Model;

class ViewUsuarios extends Model
{
    protected $table = 'users';

    protected $fillable = [];

    
    public static function _listar($e)
	{
		try
        {
            $listado = ViewUsuarios::where('docu_empre', $e)
                    //->where('activo', 1)
                    ->pluck('prim_nombr', 'docu_perso')
                    ->all();

            return $listado;
        } catch (\Exception $e){
            return response('No se Encontro Programada...!!!', 500);
        }
	}
}