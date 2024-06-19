<?php

namespace App\Http\Middleware;

use App\Exceptions\ExceptionArray;
use App\Models\Pedido;
use App\Models\Sala;
use App\Traits\JwtTrait;
use App\Traits\ResponseTrait;
use Closure;
use Exception;
use Illuminate\Http\Request;

class AuthTvMiddleware
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

            $sala = Sala::where('token', $token)->first();
            if ($sala == null) {
                throw new Exception("Sala no encontrada", 401);
            }

            $request['sala'] = $sala;
            return $next($request);
        } catch (\Throwable $th) {
            return $this->ResponseThrow($th);
        }
    }
}
