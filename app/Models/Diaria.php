<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Diaria extends Model
{
    use HasFactory;

    /**
     * Campos bloqueados na definição de dados em massa
     *
     * @var array
     */
    protected $guarded = ['motivo_cancelamento', 'created_at', 'updated_at'];

    /**
     * define a relação com servico
     *
     * @return BelongsTo
     */
    public function servico(): BelongsTo
    {
        return $this->belongsTo(Servico::class);
    }

    /**
     * define a relação com cliente
     *
     * @return BelongsTo
     */
    public function cliente(): BelongsTo
    {
        return $this->belongsTo(User::class, 'cliente_id');
    }


    /**
     * define o status da diaria como pago
     *
     * @return boolean
     */
    public function pagar(): bool
    {
        $this->status = 2;
        return $this->save();
    }

    /**
     * retorna as diarias do usuario
     *
     * @param User $usuario
     * @return Collection
     */
    static public function todasDoUsuario(User $usuario): Collection
    {
        return self::when($usuario->tipo_usuario === 1, function ($q) use ($usuario) {
                $q->where('cliente_id', $usuario->id);
            })->when($usuario->tipo_usuario === 2, function ($q) use ($usuario) {
                $q->where('diaristas_id', $usuario->id);
            })->get();


        // if ($usuario->tipo_usuario === 1) {
        //     return self::where('cliente_id', $usuario->id)->get();
        // }

        // return self::where('diaristas_id', $usuario->id)->get();
    }
}
