<?php

namespace App\Models;

use App\Core\Model;

class Cliente extends Model
{
    protected string $tabela = 'clientes';

    protected array $fillable = [
        'nome',
        'telefone',
        'email',
        'endereco',
        'documento_identificacao',
        'limite_credito',
        'saldo_devedor',
        'ativo',
    ];

    /**
     * Lista clientes com saldo devedor (fiado) em aberto.
     */
    public function comSaldoDevedor(): array
    {
        $stmt = $this->db->query(
            "SELECT * FROM {$this->tabela} WHERE saldo_devedor > 0 ORDER BY saldo_devedor DESC"
        );
        return $stmt->fetchAll();
    }

    public function registarAbatimento(int $clienteId, float $valor): bool
    {
        $stmt = $this->db->prepare(
            "UPDATE {$this->tabela} SET saldo_devedor = saldo_devedor - :valor WHERE id = :id"
        );
        return $stmt->execute(['valor' => $valor, 'id' => $clienteId]);
    }
}
