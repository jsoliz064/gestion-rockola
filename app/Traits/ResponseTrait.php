<?php

namespace App\Traits;

use App\Exceptions\ExceptionArray;
use Throwable;
use Illuminate\Support\Facades\Validator;

trait ResponseTrait
{
    public function ValidatorRequest($request, $validations, $message = null)
    {
        $validator = Validator::make($request, $validations);
        $message = $message ?: "Error de parametros";

        if ($validator->fails()) {
            throw new ExceptionArray($message, 400, $validator->errors()->all());
        }
    }

    public function ResponseError($message, $code, $errors = null)
    {
        $responseError['message'] = $message;
        $responseError['error'] = $code;
        if ($errors) {
            $responseError['errors'] = $errors;
        }
        return response()->json($responseError, $code);
    }

    public function ResponseExceptionArray(ExceptionArray $th)
    {
        $responseError['message'] = $th->getMessage();
        $responseError['error'] = $th->getCode();
        $errors = $th->getErrors();
        if ($errors) {
            $responseError['errors'] = $errors;
        }
        return response()->json($responseError, $th->getCode());
    }

    public function ResponseThrow(Throwable $th, $code = 500, $message = null)
    {
        if ($th instanceof ExceptionArray) {
            return $this->ResponseExceptionArray($th);
        }
        $message = $message ?: $th->getMessage();
        return $this->ResponseError($message, $code);
    }
}
