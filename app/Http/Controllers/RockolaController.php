<?php

namespace App\Http\Controllers;

use App\Models\Mesa;
use App\Models\Pedido;
use App\Traits\JwtTrait;
use Exception;
use Illuminate\Http\Request;

class RockolaController extends Controller
{
    use JwtTrait;

    public function rockolaMesa(Request $request, $token)
    {
        try {
            $mesa = Mesa::where('token', $token)->first();
            if ($mesa == null) {
                return view('common.abort');
            }

            $pedido = $mesa->Pedido();
            if ($pedido == null) {
                return view('common.abort');
            }

            if ($pedido->invitacion_url) {
                return view('common.abort');
            }

            $jwt = $this->encodeJWT($pedido->toArray());
            $url = config('app.MY_HOST');
            $invitacion_url = "{$url}/rockola/mesa/search/{$jwt}";
            $pedido->update([
                'invitacion_url' => $invitacion_url
            ]);
            return redirect()->route('rockola.mesa.search', $jwt);
        } catch (\Throwable $th) {
            return view('common.abort');
        }
    }

    public function rockolaMesaSearch(Request $request, $token)
    {
        try {
            $pedidoArray = $this->decodeJWT($token);
            $pedido = Pedido::find($pedidoArray->id);
            if ($pedido->terminado) {
                return view('common.abort');
            }
            return view('cruds.rockola.search', compact('token'));
        } catch (\Throwable $th) {
            return view('common.abort');
        }
    }
}
