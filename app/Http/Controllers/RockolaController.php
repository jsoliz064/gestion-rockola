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
                abort(404);
            }

            $pedido = $mesa->Pedido();
            if ($pedido == null) {
                abort(404);
            }

            if ($pedido->invitacion_url) {
                abort(404);
            }

            $jwt = $this->encodeJWT($pedido->toArray());
            $url = config('app.MY_HOST');
            $invitacion_url = "{$url}/rockola/mesa/search/{$jwt}";
            $pedido->update([
                'invitacion_url' => $invitacion_url
            ]);
            return redirect()->route('rockola.mesa.search', $jwt);
        } catch (\Throwable $th) {
            abort(404, $th->getMessage());
        }
    }

    public function rockolaMesaSearch(Request $request, $token)
    {
        try {
            $pedidoArray = $this->decodeJWT($token);
            $pedido = Pedido::find($pedidoArray->id);
            if ($pedido->terminado) {
                abort(404);
            }
            return view('cruds.rockola.search', compact('token'));
        } catch (\Throwable $th) {
            abort(404, $th->getMessage());
        }
    }
}
