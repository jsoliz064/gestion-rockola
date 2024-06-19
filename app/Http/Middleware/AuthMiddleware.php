<?php

namespace App\Http\Middleware;

use App\Exceptions\ExceptionArray;
use App\Models\Pedido;
use App\Traits\JwtTrait;
use App\Traits\ResponseTrait;
use Closure;
use Exception;
use Illuminate\Http\Request;

class AuthMiddleware
{
    use ResponseTrait, JwtTrait;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            $token = $request->header('Authorization');

            if (!$token) {
                throw new Exception("Token de Authorization Requerido", 401);
            }

            $pedidoArray = $this->decodeJWT($token);
            $pedido = Pedido::find($pedidoArray->id);
            if ($pedido == null) {
                throw new Exception("Pedido no encontrado", 401);
            }

            if ($pedido->terminado) {
                throw new Exception("Pedido de canciones finalizado", 401);
            }

            $request['pedido'] = $pedido;
            return $next($request);
        } catch (\Throwable $th) {
            return $this->ResponseThrow($th);
        }
    }
}
