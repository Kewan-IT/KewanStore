<?php

namespace App\Models;

use App\Core\Model;

class Venda extends Model
{
    protected string $tabela = 'vendas';

    protected array $fillable = [
        'caixa_id',
        'usuario_id',
        'cliente_id',
        'numero_venda',
        'subtotal',
        'desconto',
        'total',
        'forma_pagamento',
        'valor_pago',
        'troco',
        'status',
    ];

    public function vendasDoCaixa(int $caixaId): array
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->tabela} WHERE caixa_id = :caixa_id");
        $stmt->execute(['caixa_id' => $caixaId]);
        return $stmt->fetchAll();
    }
}
