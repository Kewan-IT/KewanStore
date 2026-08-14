<?php

namespace App\Models;

use App\Core\Model;

class Fornecedor extends Model
{
    protected string $tabela = 'fornecedores';

    protected array $fillable = [
        'nome',
        'contacto',
        'telefone',
        'email',
        'endereco',
        'nuit',
        'observacoes',
        'ativo',
    ];
}
