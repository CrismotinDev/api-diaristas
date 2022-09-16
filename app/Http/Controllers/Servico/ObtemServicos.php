<?php

namespace App\Http\Controllers\Servico;

use App\Http\Controllers\Controller;
use App\Http\Resources\ServicoCollection;
use App\Models\Servico;

class ObtemServicos extends Controller
{
    /**
     * Retorna a lista de serviços
     *
     * @return ServicoCollection
     */
    public function __invoke(): ServicoCollection
    {
        return new ServicoCollection(
            Servico::get()
        );
    }
}
