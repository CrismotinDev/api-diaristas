<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;

trait ApiHandler
{
    /**
     *
     * trata as exceções da nossa API
     *
     * @param \Throwable $e
     * @return JsonResponse
     */
    protected function getJsonException(\Throwable $e): JsonResponse
    {
        if ($e instanceof ValidationException) {
            return $this->validationException($e);
        }

        if ($e instanceof AuthenticationException) {
            return $this->authenticationException($e);
        }

        if ($e instanceof TokenBlacklistedException) {
            return $this->authenticationException($e);
        }

        if ($e instanceof AuthorizationException) {
            return $this->authorizationException($e);
        }

        return $this->genericException($e);
    }

    /**
     * Retorna resposta para erro de validação
     *
     * @param ValidationException $e
     * @return JsonResponse
     */
    protected function validationException(ValidationException $e): JsonResponse
    {
        return resposta_padrao("Erro de validação dos dados enviados", "validation_error", 400, $e->errors());
    }

    /**
     *Retorna uma resposta para erro de autenticacao
     *
     * @param AuthenticationException $e
     * @return void
     */
    protected function authenticationException(
        AuthenticationException|TokenBlacklistedException $e
    ) {
        return resposta_padrao($e->getMessage(), 'token_not_valid', 401);
    }

    /**
     * retorna resposta de nao autorizado
     *
     * @param AuthorizationException $e
     * @return void
     */
    protected function authorizationException(AuthorizationException $e)
    {
        return resposta_padrao(
            $e->getMessage(),
            'authorization_error',
            401
        );
    }

    /**
     * Retorna uma resposta para erro genérico
     *
     * @param \Throwable $e
     * @return JsonResponse
     */
    protected function genericException(\Throwable $e): JsonResponse
    {

        return resposta_padrao("erro interno no servidor", "internal_error", 500);
    }
}
