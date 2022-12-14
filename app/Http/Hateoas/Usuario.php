<?php

namespace App\Http\Hateoas;

use Illuminate\Database\Eloquent\Model;

class Usuario extends HateoasBase implements HateoasInterface
{
    /**
     * retorna os links dos hateos para o usuario
     *
     * @param Model|null $usuario
     * @return array
     */
    public function links(?Model $usuario): array
    {

        if ($usuario->tipo_usuario == 1) {
            $this->adicionaLink('POST', 'cadastrar_diaria', 'diarias.store');
        }
        return $this->links;
    }
}
