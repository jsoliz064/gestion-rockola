<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductoOfertaController extends Controller
{
    public function index()
    {
        return view('cruds.oferta.index');
    }
}
