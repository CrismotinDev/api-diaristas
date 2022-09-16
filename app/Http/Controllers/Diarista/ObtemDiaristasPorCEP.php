<?php

namespace App\Http\Controllers\Diarista;

use App\Actions\Diarista\ObterDiaristasPorCEP;
use App\Http\Controllers\Controller;
use App\Http\Requests\CepRequest;
use App\Http\Resources\DiaristaPublicoCollection;

class ObtemDiaristasPorCEP extends Controller
{
    public function __construct(
        ObterDiaristasPorCEP $obterDiaristasPorCep
    ) {
        $this->obterDiaristasPorCep = $obterDiaristasPorCep;
    }

    /**
     * Busca diaristas pelo Cep
     *
     * @param CepRequest $request
     * @return void
     */
    public function __invoke(CepRequest $request)
    {
        [$diaristasCollection, $quantidadeDiaristas] = $this->obterDiaristasPorCep->executar($request->cep);

        return new DiaristaPublicoCollection(
            $diaristasCollection,
            $quantidadeDiaristas
        );
    }
}
