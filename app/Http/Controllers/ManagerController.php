<?php

namespace App\Http\Controllers;
use App\Http\Responsables\HomeManager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ManagerController extends Controller
{
    public function index(Request $request)
    {
        return new HomeManager($request);
    }

}