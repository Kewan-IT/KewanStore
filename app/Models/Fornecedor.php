<?php

namespace App\Models;

use App\Core\Model;

class Fornecedor extends Model
{
    protected $table = 'fornecedores';
    
    protected $fillable = [
        'nome',
        'cnpj',
        'email',
        'telefone',
        'endereco',
        'cidade',
        'estado'
    ];
}
