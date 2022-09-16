<?php

use Illuminate\Http\JsonResponse;

if (!function_exists('resposta_padrao')) {

    /**
     * Retorna uma resposta padroniazda para a Api
     *
     */

    function resposta_padrao(

        string $message,
        string $code,
        int $statusCode,
        array $adicionais = []

    ): JsonResponse {
        return response()->json([
            "status" => $statusCode,
            "code" => $code,
            "message" => $message,
        ] + $adicionais, $statusCode);
    }
}
