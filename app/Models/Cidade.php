<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cidade extends Model
{
    use HasFactory;


    /**
     *
     * define a relação com as cidades atendidas pelo diarista
     */
    public function diaristas()
    {
        return $this->belongsToMany(User::class, 'cidade_diarista');
    }
}
