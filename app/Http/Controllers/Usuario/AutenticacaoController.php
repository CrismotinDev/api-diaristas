<?php

namespace App\Http\Controllers\Usuario;


use App\Http\Controllers\Controller;
use App\Http\Resources\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;


class AutenticacaoController extends Controller
{

    /**
     * Realiza login
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        $credenciais = $request->only(['email', 'password']);

        if (!$token = Auth::attempt($credenciais)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return resposta_token($token);
    }

    /**
     * retorna os dados do usuario logado atualmente
     *
     * @return void
     */
    public function me()
    {
        return new Usuario(Auth::user());
    }


    /**
     * invalida o token passado no header
     *
     * @return void
     */
    public function logout()

    {
        Auth::logout();

        return response()->json([
            'message' => "Successfully logged out"
        ]);
    }


    /**
     * Renova o token enviado no header
     *
     * @return void
     */
    public function refresh()
    {
        return resposta_token(Auth::refresh());
    }
}
