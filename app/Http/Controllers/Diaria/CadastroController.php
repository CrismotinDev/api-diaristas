<?php

namespace App\Http\Controllers\Diaria;

use App\Actions\Diaria\CriarDiaria;
use App\Http\Controllers\Controller;
use App\Http\Requests\DiariaRequest;
use Illuminate\Http\Request;

class CadastroController extends Controller
{
    public function index()
    {
    }
    /**
     * Undocumented function
     *
     * @param DiariaRequest $request
     * @param CriarDiaria $criarDiaria
     * @return void
     */
    public function store(DiariaRequest $request, CriarDiaria $criarDiaria)
    {
        $diaria = $criarDiaria->executar($request->all());
        return $diaria;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }
}
