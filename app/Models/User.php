<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nome_completo',
        'cpf',
        'nascimento',
        'foto_documento',
        'telefone',
        'tipo_usuario',
        'chave_pix',
        'reputacao',
        'email',
        'password',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function cidadesAtendidas()
    {
        return $this->belongsToMany(Cidade::class, 'cidade_diarista');
    }

    /**
     * Cria Escopo que filtra os diaristas
     *
     */

    public function scopeDiarista(Builder $query): Builder
    {
        return $query->where('tipo_usuario', 2);
    }

    /**
     * Cria Escopo que filtra os diaristas por codigo do ibge
     *
     */

    public function scopeDiaristasAtendeCidade(Builder $query, int $codigoIbge): Builder
    {
        return $query->diarista()
            ->whereHas('cidadesAtendidas', function ($q) use ($codigoIbge) {
                $q->where('codigo_ibge',  $codigoIbge);
            });
    }

    /**
     * Busca 6 diaristas por código do ibge
     *
     * @param integer $codigoIbge
     * @return Collection
     */
    static public function diaristasDisponivelCidade(int $codigoIbge): Collection
    {
        return User::diaristasAtendeCidade($codigoIbge)->limit(6)->get();
    }

    /**
     * Returna a quantidade de diaristas por código do ibge
     *
     * @param integer $codigoIbge
     * @return void
     */
    static public function diaristasDisponivelCidadeTotal(int $codigoIbge): int
    {
        return User::diaristasAtendeCidade($codigoIbge)->count();
    }
}
