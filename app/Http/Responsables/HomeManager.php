<?php

namespace App\Http\Responsables;

use Illuminate\Contracts\Support\Responsable;

use App\Modelos\DBGestra\ViewConductores;
use App\Modelos\DBGestra\ViewPropietarios;
use App\Modelos\DBGestra\ViewMoviles;
use App\Modelos\DBServicios\ViewListarServicios;
use App\Modelos\DBServicios\Expedicion;
use App\Modelos\Vistas\ViewListarDevices;

class HomeManager implements Responsable
{
    protected $_docu_empre = '11222333';
    protected $_accountID = 'lineas-cur';
    protected $_groupID = 'linea-XXX-cur';

    public function __construct($request)
    {
    }

    public function toResponse($request)
    {
        $docu_empre = $this->_docu_empre;
        $data = [
            'title'     => 'Manager',
            'subtitle'  => 'Sistema de Gestion',
            'modulos'   => $this->_losModulos($docu_empre)
        ];
        return view('manager.vista', compact('data'));
    }


    private function _losModulos($docu_empre)
    {
        $desde = strtotime(date('Y-m-d', strtotime('first day of this month')));
        $hasta = strtotime(date('Y-m-d', strtotime('last day of this month')));

        $desde = date('Y-m-d H:i:s', $desde);
        $hasta = date('Y-m-d H:i:s', $hasta);

        return array(
            [
                'title'  => 'Conductores',
                'icono' => 'fa fa-id-card fa-1x',
                'color' => 'bg-blue',
                'route' =>
                [
                    'add' => '#!',
                    'list' => route('manager.conductores')
                ],
                'total' => ViewConductores::_listar($docu_empre)->count()
            ],
            [
                'title'  => 'Propietarios',
                'icono' => 'fa fa-users fa-1x',
                'color' => 'bg-red',
                'route' =>
                [
                    'add' => '#!',
                    'list' => route('manager.propietarios')
                ],
                'total' => ViewPropietarios::_listar($docu_empre)->count()
            ],
            [
                'title'  => 'Moviles',
                'icono' => 'fa fa-bus fa-1x',
                'color' => 'bg-olive',
                'route' =>
                [
                    'add' => '#!',
                    'list' => route('manager.moviles')
                ],
                'total' => ViewMoviles::_listar($docu_empre)->count()
            ],
            [
                'title'  => 'Servicios',
                'icono' => 'fa fa-tasks fa-1x',
                'color' => 'bg-navy',
                'route' =>
                [
                    'add' => '#!',
                    'list' => '#!',
                ],
                'total' => ViewListarServicios::where('docu_empre', $docu_empre)
                    ->whereBetween('inic_servi', [$desde, $hasta])
                    ->get()->count()
            ],
            [
                'title'  => 'Expediciones',
                'icono' => 'fa fa-line-chart fa-1x',
                'color' => 'bg-teal',
                'route' =>
                [
                    'add' => '#!',
                    'list' => '#!'
                ],
                'total' => Expedicion::where('docu_empre', $this->_docu_empre)
                    ->whereBetween('inic_exped', [$desde, $hasta])
                    ->where('procesada', 0)->get()->count()
            ],
            [
                'title'  => 'Equipos',
                'icono' => 'fa fa-hdd-o fa-1x',
                'color' => 'bg-orange',
                'route' =>
                [
                    'add' => '#!',
                    'list' => route('manager.equipos')
                ],
                'total' => ViewListarDevices::where('accountID', $this->_accountID)->where('groupID', $this->_groupID)->get()->count()
            ]
        );
    }
}
