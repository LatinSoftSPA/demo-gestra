<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;


class LoginController extends Controller
{

    use AuthenticatesUsers;

    protected $redirectTo = '/bienvenida';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function credentials(Request $request)
    {
        $docu_perso = $this->username();
        $credentials = $request->only($docu_perso, 'password');
        // $credentials['activo'] = 1;
        return $credentials;
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        $docu_perso = $this->username();
        $errors = [$docu_perso => trans('Usuario y/o Contraseña Invalido')];
        // Load user from database
        $user = \App\User::where($docu_perso, $request->{$docu_perso})->first();
        // Check if user was successfully loaded, that the password matches
        // and active is not 1. If so, override the default error message.
        if ($user && \Hash::check($request->password, $user->password) && $user->activo != 1) {
            $errors = [$docu_perso => 'Usuario DesActivado.'];
        }
        if ($request->expectsJson()) {
            return response()->json($errors, 422);
        }
        return redirect()
            ->back()
            ->withInput($request->only($docu_perso, 'remember'))
            ->withErrors($errors);
    }

    public function username()
    {
        return 'docu_perso';
    }
    public function showLoginForm()
    {
        return view('controlAcceso.vista');
    }
}
