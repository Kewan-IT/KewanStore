<?php

namespace App\Models;

use App\Core\Model;

class Caixa extends Model
{
    protected $table = 'caixa';
    
    protected $fillable = [
        'usuario_id',
        'data_abertura',
        'data_fechamento',
        'valor_abertura',
        'valor_fechamento',
        'status'
    ];
}
