<?php

namespace App\Models;

use App\Core\Model;

class Caixa extends Model
{
    protected string $tabela = 'caixa';

    protected array $fillable = [
        'usuario_id',
        'valor_abertura',
        'valor_fechamento',
        'valor_esperado',
        'diferenca',
        'observacoes',
        'status',
    ];

    public function caixaAbertoDoUsuario(int $usuarioId): array|false
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM {$this->tabela} WHERE usuario_id = :usuario_id AND status = 'aberto' LIMIT 1"
        );
        $stmt->execute(['usuario_id' => $usuarioId]);
        return $stmt->fetch();
    }
}
