<?php

namespace App\Models;

use App\Core\Model;

class Produto extends Model
{
    protected $table = 'produtos';
    
    protected $fillable = [
        'nome',
        'descricao',
        'preco',
        'categoria_id',
        'fornecedor_id',
        'quantidade',
        'imagem'
    ];
}
