<?php

namespace App\Models;

use App\Core\Model;

class Venda extends Model
{
    protected $table = 'vendas';
    
    protected $fillable = [
        'cliente_id',
        'data_venda',
        'total',
        'desconto',
        'status'
    ];
}
