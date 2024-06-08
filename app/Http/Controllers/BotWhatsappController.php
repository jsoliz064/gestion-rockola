<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BotWhatsappController extends Controller
{
    public function scanQr()
    {
        return view('cruds.bot.scanQr');
    }
}
