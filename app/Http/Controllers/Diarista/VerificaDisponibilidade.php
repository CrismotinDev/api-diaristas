<?php

namespace App\Http\Controllers\Diarista;

use App\Actions\Diarista\ObterDiaristasPorCEP;
use App\Http\Controllers\Controller;
use App\Http\Requests\CepRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VerificaDisponibilidade extends Controller
{

    public function __construct(
        ObterDiaristasPorCEP $obterDiaristasPorCep
    ) {
        $this->obterDiaristasPorCep = $obterDiaristasPorCep;
    }
    /**
     * Retorna a disponibilidade de diarista para um CEP
     *
     * @param CepRequest $request
     * @return JsonResponse
     */

    public function __invoke(CepRequest $request): JsonResponse
    {

        [$diaristasCollection] = $this->obterDiaristasPorCep->executar($request->cep);

        return resposta_padrao(
            "Disponibilidade verificada com sucesso",
            "success",
            200,
            ["disponibilidade" => $diaristasCollection->isNotEmpty()]
        );
    }
}
