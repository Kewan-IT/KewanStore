<?php

namespace App\Models;

use App\Core\Model;

class Produto extends Model
{
    protected string $tabela = 'produtos';

    protected array $fillable = [
        'categoria_id',
        'nome',
        'codigo_barras',
        'unidade_medida',
        'preco_custo',
        'preco_venda',
        'estoque_atual',
        'estoque_minimo',
        'controla_validade',
        'imagem',
        'ativo',
    ];

    /**
     * Lista produtos com stock igual ou abaixo do mínimo definido.
     */
    public function comEstoqueBaixo(): array
    {
        $stmt = $this->db->query(
            "SELECT * FROM {$this->tabela} WHERE estoque_atual <= estoque_minimo AND ativo = 1"
        );
        return $stmt->fetchAll();
    }

    public function buscarPorCodigoBarras(string $codigo): array|false
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->tabela} WHERE codigo_barras = :codigo LIMIT 1");
        $stmt->execute(['codigo' => $codigo]);
        return $stmt->fetch();
    }
}
