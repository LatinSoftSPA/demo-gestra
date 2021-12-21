<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
	protected $connection = 'db_latinsoft';
	
	protected $events = [
        'Login' => Illuminate\Auth\Events\Login::class,
    ];

    protected $table = 'tb_sessiones';
	protected $primaryKey = 'docu_perso';
	protected $fillable = [
		'docu_perso', 'docu_empre', 'habilitado', 'fech_inici', 'fech_termi', 'ip', 'token',
	];
    
}
