<?php

namespace App\Actions\Usuario;

use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;

class CriarUsuario
{
    /**
     *
     * Cadastra um usuario no banco de dados
     */

    public function executar(array $dados, UploadedFile $fotoDocumento)
    {
        $dados['foto_documento'] = $fotoDocumento->store('local');
        $dados['password'] = Hash::make($dados['password']);
        User::created($dados);
    }
}
