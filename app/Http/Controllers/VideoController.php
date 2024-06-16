<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index()
    {
        return view('cruds.video.index');
    }

    public function getAll()
    {
        $videos = Video::all();
        return response()->json($videos, 200);
    }
}
