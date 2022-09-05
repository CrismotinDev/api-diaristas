<?php

namespace App\Services\ConsultaCEP\Providers;

use Illuminate\Support\Facades\Http;
use App\Services\ConsultaCEP\EnderecoResponse;
use App\Services\ConsultaCEP\ConsultaCEPInterface;

class ViaCEP implements ConsultaCEPInterface
{
    /**
     * Buscar endereço utizando a api do viaCEP
     *
     * @param string $cep
     * @return false|EnderecoResponse
     */
    public function buscar(string $cep)
    {
        $resposta = Http::get("https://viacep.com.br/ws/$cep/json/");

        if ($resposta->failed()) {
            return false;
        }

        $dados = $resposta->json();

        if (isset($dados['erro']) && $dados['erro'] === true) {
            return false;
        }

        return $this->populaEnderecoResponse($dados);
    }

    /**
     * Formata a saída para endereço response
     *
     * @param array $dados
     * @return EnderecoResponse
     */
    private function populaEnderecoResponse(array $dados): EnderecoResponse
    {
        return new EnderecoResponse(
            $dados['cep'],
            $dados['logradouro'],
            $dados['complemento'],
            $dados['bairro'],
            $dados['localidade'],
            $dados['uf'],
            $dados['ibge'],
        );
    }
}