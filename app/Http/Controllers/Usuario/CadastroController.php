<?php

namespace App\Http\Controllers\Usuario;

use App\Actions\Usuario\CriarUsuario;
use App\Http\Controllers\Controller;
use App\Http\Resources\Usuario;
use App\Models\User;
use Illuminate\Http\Request;

class CadastroController extends Controller
{

    public function __construct(
        CriarUsuario $criarUsuario
    ) {
        $this->criarUsuario = $criarUsuario;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $usuario = $this->criarUsuario->executar(
            $request->except('password_confirmation'),
            $request->foto_documento
        );
        return new Usuario($usuario);

    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    }
}
