<?php

namespace App\Http\Responsables\Monitores;

use Illuminate\Contracts\Support\Responsable;

use App\Modelos\DBServicios\ViewServicios;

class FrecuenciaServicios implements Responsable
{
	protected $_codi_circu;
	protected $_fech_servi;

	protected $_docu_empre = '96711420';

	public function __construct($request)
	{
		$this->_codi_circu = $request->codi_circu;
		$this->_fech_servi = $request->fech_servi;
	}

	public function toResponse($request)
	{
        $data = 
        [
            'title'     => 'Circuito : Troncal 104',
            'subtitle'  => '(IDA - REG)',
            'codi_circu'=> $this->_codi_circu,
        ];

        return view('monitores.frecuencia.vista', compact('data'));
    }
}