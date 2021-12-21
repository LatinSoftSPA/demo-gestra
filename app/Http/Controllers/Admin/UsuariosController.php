<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Requests\UsuariosRequest;
use Laracast\Flash\Flash;

use App\User;

use App\Modelos\Persona;
use App\Modelos\Domicilio;
use App\Modelos\Contacto;
use App\Modelos\Usuario;

class UsuariosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $data = 
        [
            'title'     => 'Administracion',
            'subtitle'  => 'Usuarios',
            'buscare'   => 'nomb_geozo',
            'listado'   => User::where('docu_empre', $this->_docu_empre)->get(),
        ];

        return view('administrador.usuarios.vista', compact('data'));
    }

    public function create()
    {
        $lstNacionalidades = $this::listadoNacionalidades();
        $lstECiviles = $this::listadoECivil();
        $lstProvincias = $this::listadoProvincias();
        $lstTiposUsuario = $this::listadoTUsuarios();
        
        return view('usuarios.create.vista', compact('lstNacionalidades', 'lstECiviles', 'lstProvincias', 'lstTiposUsuario'));
    }

    public function store(Request $request)
    {
        if($request->ajax()){
            $objPersona = Persona::find($request->all());

            //if (!$objPersona){
            if (count($objPersona) === 0){
                Persona::create($request->all());
                Domicilio::create($request->all());
                Contacto::create($request->all());            
            }
            Usuario::create($request->all());
            $mensaje = '<b>Nota: </b>Usuario Agregado Correctamente.';
            return response()->json([
                'msg' => $mensaje, 
                'clr' => 'alert-success'
            ]);
        }
    }

    public function show($docu_perso)
    {

    }

    public function edit($docu_perso)
    {

        $objPersona = Persona::
                        where('docu_perso', $docu_perso)->get();
        $objDomicilio = Domicilio::
                        where('docu_perso', $docu_perso)->get();
        $objContacto = Contacto::
                        where('docu_perso', $docu_perso)->get();
        $objUsuario = Usuario::
                        where('docu_perso', $docu_perso)->
                        where('docu_empre', $this->_docu_empre)->get();

        $lstNacionalidades = $this::listadoNacionalidades();
        $lstECiviles = $this::listadoECivil();
        $lstProvincias = $this::listadoProvincias();
        $lstTiposUsuario = $this::listadoTUsuarios();
        
        return view('usuarios.edit.vista', compact('objPersona', 'objDomicilio', 'objContacto', 'objUsuario', 'lstNacionalidades', 'lstECiviles', 'lstProvincias', 'lstTiposUsuario'));
    }

    public function update(Request $request, $docu_perso)
    {
        if($request->ajax()){
            Persona::find($docu_perso)->update($request->all());
            Domicilio::find($docu_perso)->update($request->all());
            Contacto::find($docu_perso)->update($request->all());

            Usuario::find($docu_perso)->update($request->all());


            $mensaje = '<b>Nota: </b>Usuario Editado Correctamente.';
            return response()->json([
                'msg' => $mensaje, 
                'clr' => 'alert-success'
            ]);
        }
    }

    public function destroy(Request $request, $docu_perso)
    {
        if($request->ajax()){
            Usuario::find($docu_perso)->delete();

            $mensaje = '<b>Nota: </b>Usuario Eliminado Correctamente.';
            return response()->json([
                'msg' => $mensaje, 
                'clr' => 'alert-success'
            ]);
        }
    }
}
