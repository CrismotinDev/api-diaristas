<?php

namespace App\Models;

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
}
