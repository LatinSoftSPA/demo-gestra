<?php

namespace App\Http\Responsables\Manager\Moviles;

use Illuminate\Contracts\Support\Responsable;

use App\Modelos\DBGestra\Movil;

class Buscar implements Responsable
{
        protected $_docu_empre = '11222333';
        protected $_pate_movil;
        protected $_nume_movil;

        public function __construct($request)
        {
                $this->_pate_movil = $request->pate_movil;
                $this->_nume_movil = $request->nume_movil;
        }

        public function toResponse($request)
        {
                $docu_empre = $this->_docu_empre;
                $pate_movil = $this->_pate_movil;
                $nume_movil = $this->_nume_movil;
                $data =
                        [
                                'objMoviles'       => Movil::where('docu_empre', $docu_empre)
                                        ->where('pate_movil', $pate_movil)
                                        ->where('nume_movil', $nume_movil)
                                        ->limit(1)
                                        ->get(),
                        ];
                return $data;
        }
}
