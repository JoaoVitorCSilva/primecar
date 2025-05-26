<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CatalogoController extends Controller
{
    public function index(Request $request)
    {
        return view('catalogo.index');
    }
}
