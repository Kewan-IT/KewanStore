<?php

namespace App\Models;

use App\Core\Model;

class VendaItem extends Model
{
    protected $table = 'venda_items';
    
    protected $fillable = [
        'venda_id',
        'produto_id',
        'quantidade',
        'preco_unitario',
        'subtotal'
    ];
}
