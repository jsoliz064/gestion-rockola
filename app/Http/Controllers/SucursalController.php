<?php

namespace App\Http\Controllers;

use App\Models\Sucursal;
use App\Traits\ResponseTrait;
use App\Traits\ValidateRequestTrait;

class SucursalController extends Controller
{
    use ResponseTrait, ValidateRequestTrait;

    public function show(Sucursal $sucursal)
    {
        return view('cruds.sucursal.show', compact('sucursal'));
    }
}
