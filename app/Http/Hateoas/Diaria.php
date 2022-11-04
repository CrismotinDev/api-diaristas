<?php

namespace App\Http\Hateoas;

use Illuminate\Database\Eloquent\Model;

class Diaria extends HateoasBase implements HateoasInterface
{

    public function links(?Model $diaria): array
    {

        $this->adicionaLink('POST', 'pagar_diaria', 'diarias.pagar', ['diaria' => $diaria->id]);

        return $this->links;
    }
}
