<?php

namespace App\Actions\Diaria;

use App\Models\Diaria;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\ValidationException;

class PagarDiaria
{
    /**
     * executa o pagamento da diaria
     *
     * @param Diaria $diaria
     * @param string $cardHas
     * @return boolean
     */
    public function executar(Diaria $diaria, string $cardHas): bool
    {

        $this->validaStatusDiaria($diaria);
        Gate::authorize('tipo-cliente');
        Gate::authorize('dono-diaria', $diaria);

        //integração com gateway de pagamento

        return $diaria->pagar();
    }

    /**
     * valida status da diaria e igual a 1
     *
     * @param Diaria $diaria
     * @return void
     */
    private function validaStatusDiaria(Diaria $diaria): void
    {
        if ($diaria->status != 1) {
            throw ValidationException::withMessages([
                'status-diaria' => 'Só é possivel executar essa ação com diarias com status 1'
            ]);
        }
    }
}
