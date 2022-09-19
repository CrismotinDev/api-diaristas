<?php

namespace App\Http\Controllers\Endereco;

use App\Http\Controllers\Controller;
use App\Http\Requests\CepRequest;
use App\Services\ConsultaCEP\ConsultaCEPInterface;
use Illuminate\Validation\ValidationException;

class BuscaCepApiExterna extends Controller
{
    private ConsultaCEPInterface $consultaCep;

    public function __construct(
        ConsultaCEPInterface $consultaCep
    ) {
        $this->consultaCep = $consultaCep;
    }
    /**
     * retorna os dados de endereco a partir do cep
     *
     * @param CepRequest $request
     * @return array
     */

    public function __invoke(CepRequest $request): array
    {

        $dadosEndereco = $this->consultaCep->buscar($request->cep);

        if ($dadosEndereco === false) {
            throw ValidationException::withMessages(['cep' => 'Cep não encontrado']);
        }
        return (array) $dadosEndereco;
    }
}
