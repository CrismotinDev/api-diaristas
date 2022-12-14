<?php

namespace App\Observers;

use App\Mail\UsuarioCadastrado;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class UserObserver
{
    public function creating(User $user)
    {
        if (User::count() === 0) {
            $user->reputacao = 5;
            return;
        }

        $user->reputacao = User::avg('reputacao');
    }

    /**
     * Envio de boas vindas ao usuario
     *
     * @param User $user
     * @return void
     */
    public function created(User $user)
    {
        Mail::to($user->email)->send(new UsuarioCadastrado($user));
    }
}
