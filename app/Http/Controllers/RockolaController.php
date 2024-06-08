<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RockolaController extends Controller
{
    public function search()
    {
        return view('cruds.rockola.search');
    }

    public function playlist()
    {
        return view('cruds.rockola.playlist');
    }
}
