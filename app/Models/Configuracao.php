<?php

namespace App\Models;

use App\Core\Model;

/**
 * A tabela `configuracoes` tem uma única linha com colunas fixas
 * (nome_loja, moeda, etc.) em vez de um formato chave-valor.
 */
class Configuracao extends Model
{
    protected string $tabela = 'configuracoes';

    protected array $fillable = [
        'nome_loja',
        'logotipo',
        'endereco',
        'telefone',
        'email',
        'nuit',
        'moeda',
        'permite_venda_abaixo_estoque',
        'dias_alerta_validade',
        'estoque_minimo_padrao',
    ];

    /**
     * Devolve a linha única de configurações (cria uma por omissão se não existir).
     */
    public function obter(): array
    {
        $stmt = $this->db->query("SELECT * FROM {$this->tabela} ORDER BY id LIMIT 1");
        $config = $stmt->fetch();

        if (!$config) {
            $id = $this->inserir(['nome_loja' => 'KewanStore', 'moeda' => 'MZN']);
            return $this->encontrarPorId($id);
        }

        return $config;
    }

    public function atualizarConfig(array $dados): bool
    {
        $config = $this->obter();
        return $this->atualizar($config['id'], $dados);
    }
}
