<?php

namespace App\Http\Responsables;

use Illuminate\Contracts\Support\Responsable;

use App\Modelos\DBGts\ViewGeozonas;

use App\Modelos\DBGestra\Circuito;
use App\Modelos\DBServicios\Ruta;
use App\Modelos\DBLatinsoft\Empresa;
use App\Modelos\DBLatinsoft\Simcard;


use App\User;

class HomeAdministracion implements Responsable
{
    protected $_docu_empre = '11222333';

    public function __construct($request)
    {
    }

    public function toResponse($request)
    {
        $data = [
            'title'     => 'Administracion',
            'subtitle'  => 'Sistema General',
            'modulos'   => $this->_losModulos()
        ];
        return view('administrador.vista', compact('data'));
    }



    private function _losModulos()
    {
        return array(
            [
                'title'  => 'Empresas',
                'icono' => 'fa fa-bank fa-1x',
                'color' => 'bg-orange',
                'route' =>
                [
                    'add' => '#!',
                    'list' => route('empresas.index')
                ],
                'total' => Empresa::get()->count()
            ],
            [
                'title'  => 'Usuarios',
                'icono' => 'fa fa-user-circle-o fa-1x',
                'color' => 'bg-aqua',
                'route' =>
                [
                    'add' => '#!',
                    'list' => route('usuarios.index')
                ],
                'total' => User::get()->count()
            ],
            [
                'title'  => 'Chips',
                'icono' => 'fa fa-microchip fa-1x',
                'color' => 'bg-teal',
                'route' =>
                [
                    'add' => '#!',
                    'list' => '#!'
                ],
                'total' => Simcard::where('docu_empre', $this->_docu_empre)->get()->count()
            ],
            [
                'title'  => 'Circuitos',
                'icono' => 'fa fa-map-o fa-1x',
                'color' => 'bg-gray',
                'route' =>
                [
                    'add' => '#!',
                    'list' => route('administrar.circuitos')
                ],
                'total' => Circuito::get()->count()
            ],
            [
                'title'  => 'Rutas',
                'icono' => 'fa fa-map-signs fa-1x',
                'color' => 'bg-info',
                'route' =>
                [
                    'add' => '#!',
                    'list' => route('administrar.rutas')
                ],
                'total' => Ruta::where('docu_empre', $this->_docu_empre)->get()->count()
            ],
            [
                'title'  => 'GeoZonas',
                'icono' => 'fa fa-crosshairs fa-1x',
                'color' => 'bg-success',
                'route' =>
                [
                    'add' => '#!',
                    'list' => route('administrar.geozonas')

                ],
                'total' => ViewGeozonas::get()->count()
            ]
        );
    }
}
