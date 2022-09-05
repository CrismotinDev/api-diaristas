<?php

namespace App\Services\ConsultaCEP;

class EnderecoResponse
{
    public string $cep;
    public string $logradouro;
    public string $complemento;
    public string $bairro;
    public string $localidade;
    public string $uf;
    public string $ibge;

    public function __construct(
        string $cep,
        string $logradouro,
        string $complemento,
        string $bairro,
        string $localidade,
        string $uf,
        string $ibge
    ) {
        $this->cep = $cep;
        $this->logradouro = $logradouro;
        $this->complemento = $complemento;
        $this->bairro = $bairro;
        $this->localidade = $localidade;
        $this->uf = $uf;
        $this->ibge = $ibge;
    }
}
