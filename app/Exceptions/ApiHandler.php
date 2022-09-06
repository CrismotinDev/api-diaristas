<?php

namespace App\Exception;

use Illuminate\Validation\ValidationException;

trait ApiHandler
{
    protected function getJsonException(\Throwable $e)
    {
        // if ($e instanceof ValidationException) {
        //     return response()->json([
        //         "status" => 400,
        //         "code" => "Validation_error",
        //         "message" => "Erro de validação dos dados enviados"
        //     ] + $e->errors(), 400);
        // }

        // return response()->json([
        //     "status" => 500,
        //     "code" => "internal_error",
        //     "message" => "erro interno no servidor"
        // ], 500);
    }
}
