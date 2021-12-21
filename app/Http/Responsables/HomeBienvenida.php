<?php

namespace App\Http\Responsables;

use Illuminate\Contracts\Support\Responsable;

class HomeBienvenida implements Responsable
{
    protected $_docu_empre = '96711420';
    
    public function __construct($request)
    {
    }

    public function toResponse($request)
    {        
        $data = 
        [
            'title'     => 'Bienvenidos a ',
            'subtitle'  => config('app.name', 'APP') .' '.config('app.version', 'v2019') 
        ];

        return view('bienvenida', compact('data'));
    }    
}