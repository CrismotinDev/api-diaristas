<?php

use App\Http\Controllers\Usuario\AutenticacaoController;
use Illuminate\Support\Facades\Route;

Route::post('/token', [AutenticacaoController::class, 'login'])->name('autenticacao.login');

Route::post('/logout', [AutenticacaoController::class, 'logout'])
    ->middleware('auth:api')
    ->name('authenticacao.logout');

Route::post('/token/refresh', [AutenticacaoController::class, 'refresh'])->name('autenticacao.refresh');
