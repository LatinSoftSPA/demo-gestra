<?php

namespace App\Http\Controllers;
use App\Http\Responsables\HomeBienvenida;

use Illuminate\Http\Request;
class BienvenidaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        return new HomeBienvenida($request);
    }
}