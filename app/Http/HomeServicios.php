<?php

namespace App\Http\Responsables\Vistas;

use Illuminate\Contracts\Support\Responsable;

use App\Modelos\DBGestra\Circuito;

class HomeServicios implements Responsable
{
	protected $servicios;

	public function __construct($servicios)
	{
		$this->servicios = $servicios;
	}

	public function toResponse($request)
	{
		$circuitos = Circuito::orderBy('nomb_circu', 'ASC')
			->where('habilitado', 1)
            ->pluck('nomb_circu', 'codi_circu')
            ->all();

		$data = [
            'title' 		=> 'Gestion',
            'subtitle' 		=> 'Servicios',
            'lstCircuitos' 	=> $circuitos
        ];
    	return view('servicios.vista', compact('data'));
	}
}