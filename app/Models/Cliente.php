<?php

namespace App\Models;

use App\Core\Model;

class Cliente extends Model
{
    protected $table = 'clientes';
    
    protected $fillable = [
        'nome',
        'cpf',
        'email',
        'telefone',
        'endereco',
        'cidade',
        'estado'
    ];
}
