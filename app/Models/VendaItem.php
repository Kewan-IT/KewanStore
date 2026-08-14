<?php

namespace App\Models;

use App\Core\Model;

class VendaItem extends Model
{
    protected string $tabela = 'venda_itens';
    
    protected array $fillable = [
        'venda_id',
        'produto_id',
        'lote_id',
        'quantidade',
        'preco_unitario',
        'desconto',
        'subtotal',
    ];
}
