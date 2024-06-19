<?php

namespace App\Http\Controllers;

use App\Models\Sucursal;

class SucursalController extends Controller
{

    public function show(Sucursal $sucursal)
    {
        return view('cruds.sucursal.show', compact('sucursal'));
    }
}
