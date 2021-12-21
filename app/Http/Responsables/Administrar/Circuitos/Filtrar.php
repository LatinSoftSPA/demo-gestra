<?php

namespace App\Http\Responsables\Administrar\Circuitos;

use Illuminate\Contracts\Support\Responsable;

use App\Modelos\DBGestra\ViewCircuitos;
class Filtrar implements Responsable
{
    protected $_docu_empre = '96711420';
    protected $_nomb_circu;

    public function __construct($request)
    {
        $this->_nomb_circu = $request->nomb_circu;
    }

    public function toResponse($request)
    {
        $docu_empre = $this->_docu_empre;
        $nomb_circu = $this->_nomb_circu;

        try{
            $lst = ViewCircuitos::_filtrar($docu_empre, $nomb_circu);
            if($lst->count() > 0){
                return response()->json([
                        'listado'   => $lst->toArray(),
                        'total'     => $lst->count()
                ], 200);
            } else {
                return response('Nota: No se Encontraron Circuitos.', 404);
            }
        } catch (\Exception $e){
            return response('Algo salio mal...!!!', 500);
        }
    }
}