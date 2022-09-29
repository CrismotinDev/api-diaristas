<?php

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

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

/**
 * retorna uma resposta padrao para os tokens de autenticação
 */
if (!function_exists('resposta_token')) {
    function resposta_token(string $token): JsonResponse
    {
        return response()->json([
            'access' => $token,
            'refresh' => $token,
            'token_type' => 'bearer',
            'expire_in' => Auth::factory()->getTTL() * 60
        ]);
    }
}
