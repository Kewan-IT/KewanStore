<?php

namespace App\Models;

use App\Core\Model;

class Categoria extends Model
{
    protected $table = 'categorias';
    
    protected $fillable = [
        'nome',
        'descricao'
    ];
}
