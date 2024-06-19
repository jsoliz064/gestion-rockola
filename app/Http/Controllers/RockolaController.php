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

    public function mesaSearch(Request $request, $jwt)
    {
        try {
            $pedidoArray = $this->decodeJWT($jwt);
            $pedido = Pedido::find($pedidoArray->id);
            if ($pedido->terminado) {
                abort(404);
            }
            return view('cruds.rockola.search');
        } catch (\Throwable $th) {
            abort(404, $th->getMessage());
        }
    }
}
