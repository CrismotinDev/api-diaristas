<?php

namespace App\Exceptions;

use App\Exception\ApiHandler;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{

    // use ApiHandler;
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }


    /**
     * faz o tratamento das exceções no laravel
     *
     * @param [type] $request
     * @param Throwable $e
     * @return void
     */

    public function render($request, Throwable $e)
    {
        if ($request->is('api/*')) {
            if ($e instanceof ValidationException) {
                return $this->validationException($e);
            }

            return $this->genericException($e);
        }
        return parent::render($request, $e);
    }

    protected function validationException(ValidationException $e)
    {
        return response()->json([
            "status" => 400,
            "code" => "Validation_error",
            "message" => "Erro de validação dos dados enviados"
        ] + $e->errors(), 400);
    }

    protected function genericException(\Throwable $e)
    {
        return response()->json([
            "status" => 500,
            "code" => "internal_error",
            "message" => "erro interno no servidor"
        ], 500);
    }
}
