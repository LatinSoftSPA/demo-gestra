<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/bienvenida';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }


    public function showRegistrationForm()
    {
        // return view('manager.usuarios.create');
        return view('auth.register');
    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'prim_nombr' => 'required|string|max:255',
            'segu_nombr' => 'required|string|max:255',
            'apel_pater' => 'required|string|max:255',
            'apel_mater' => 'required|string|max:255',

            'email' => 'required|string|email|max:255|unique:users',
            'rol' => 'required',
            'docu_perso' => 'required|min:7|max:8|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'docu_perso' => $data['docu_perso'],
            'prim_nombr' => $data['prim_nombr'],
            'segu_nombr' => $data['segu_nombr'],
            'apel_pater' => $data['apel_pater'],
            'apel_mater' => $data['apel_mater'],

            'email' => $data['email'],
            'rol' => $data['rol'],
            'password' => Hash::make($data['password']),

            'activo' => true,
            'online' => false,
            'foto_perfil' => 'male.png',
        ]);
    }
}
