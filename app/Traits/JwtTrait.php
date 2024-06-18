<?php

namespace App\Traits;

use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

trait JwtTrait
{
    public $hash = "HS256";

    public function encodeJWT($data = [])
    {
        $key = config('app.JWT_KEY');
        $hours = config('app.JWT_EXPIRATION_HOURS');
        $now = time();
        $exp = $now + (60 * 60 * $hours);
        $data['exp'] = $exp;
        $token = JWT::encode($data, $key, $this->hash);
        return $token;
    }

    public function decodeJWT($token)
    {
        $key = config('app.JWT_KEY');
        try {
            $decoded = JWT::decode($token, new Key($key, $this->hash));
            return $decoded;
        } catch (\Firebase\JWT\ExpiredException $e) {
            throw new Exception('El token ha expirado');
        } catch (\Firebase\JWT\SignatureInvalidException $e) {
            throw new Exception('El token es invalido - Signature invalid');
        } catch (\Exception $e) {
            throw new Exception('Token invalido');
        }
    }
}
