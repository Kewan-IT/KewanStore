<?php

namespace App\Models;

use App\Core\Model;

class Categoria extends Model
{
    protected string $tabela = 'categorias';
    
    protected array $fillable = [
        'nome',
        'descricao',
        'ativo',
    ];
}
