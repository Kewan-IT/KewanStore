<?php

namespace App\Models;

use App\Core\Model;

class Compra extends Model
{
    protected string $tabela = 'compras';

    protected array $fillable = [
        'fornecedor_id',
        'usuario_id',
        'numero_documento',
        'subtotal',
        'desconto',
        'total',
        'status',
        'observacoes',
    ];
}
