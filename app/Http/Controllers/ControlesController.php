<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Modelos\Vistas\ViewListarPuntosControl;

class ControlesController extends Controller
{

	public function listarPuntosControl(Request $request)
	{
    	if($request->ajax()){
			try {
				$lstPuntosControl = ViewListarPuntosControl::where('codi_circu', $request->codi_circu)->
									where('docu_empre', $this->_docu_empre)->
									get();
				return response()->json([
                        'listado' => $lstPuntosControl->all(),
                        'total' => $lstPuntosControl->count()
                ]);
			} catch (Exception $e) {
				return response()->json(['msg' => 'Algo Salio Mal: ' .$e->getMessage()]);
			}
		}
	}

	
}