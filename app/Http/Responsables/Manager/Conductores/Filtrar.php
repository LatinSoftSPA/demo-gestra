<?php

namespace App\Http\Responsables\Manager\Conductores;

use Illuminate\Contracts\Support\Responsable;

use App\Modelos\DBGestra\ViewConductores;

class Filtrar implements Responsable
{
	protected $_docu_empre = '96711420';
    protected $_apel_pater;

	public function __construct($request)
	{
        $this->_apel_pater = $request->apel_pater;
	}

	public function toResponse($request)
	{
        $docu_empre = $this->_docu_empre;
        $apel_pater = $this->_apel_pater;
        $listado = ViewConductores::_filtrar($docu_empre, $apel_pater);
        
        if($listado->count() > 0){
            return response()->json([
                    'listado' => $listado->toArray(),
                    'total' => $listado->count()
            ], 200);
        } else {
            return response('No se Encontraron Conductores con este Apellido.', 404);
        }
	}
}