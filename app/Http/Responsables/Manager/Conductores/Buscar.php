<?php

namespace App\Http\Responsables\Manager\Conductores;

use Illuminate\Contracts\Support\Responsable;

use App\Modelos\DBGestra\Conductor;
use App\Modelos\DBGestra\Licencia;

use App\Modelos\DBLatinsoft\Persona;
use App\Modelos\DBLatinsoft\Domicilio;
use App\Modelos\DBLatinsoft\Contacto;

use App\Modelos\DBLatinsoft\Nacionalidad;
use App\Modelos\DBLatinsoft\ECivil;
use App\Modelos\DBLatinsoft\Provincia;

class Buscar implements Responsable
{
	protected $_docu_empre = '96711420';
    protected $_codi_licen;
    protected $_docu_perso;

	public function __construct($request)
	{
        $this->_codi_licen = $request->codi_licen;
        $this->_docu_perso = $request->docu_perso;
	}

	public function toResponse($request)
	{
        $docu_empre = $this->_docu_empre;
        $codi_licen = $this->_codi_licen;
        $docu_perso = $this->_docu_perso;

        $data = 
        [
            'lstNacionalidades' => Nacionalidad::_listar(),
            'lstECiviles'       => ECivil::_listar(),
            'lstProvincias'     => Provincia::_listar(),

            'objPersona'        => Persona::_buscar($docu_perso),
            'objDomicilio'      => Domicilio::_buscar($docu_perso),
            'objContacto'       => Contacto::_buscar($docu_perso),

            'objConductor'      => Conductor::_buscar($docu_perso),
            'objLicencia'       => Licencia::_buscar($docu_perso),
        ];
        return $data;
	}
}