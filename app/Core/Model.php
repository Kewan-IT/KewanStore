<?php

namespace App\Core;

use PDO;

/**
 * Classe base para todos os Models. Fornece acesso à conexão PDO
 * e métodos auxiliares comuns (find, all, delete) para reduzir
 * repetição nos models concretos.
 */
abstract class Model
{
    protected PDO $db;

    // Nome da tabela — cada model filho deve definir isto
    protected string $tabela;

    // Chave primária — pode ser sobrescrita se necessário
    protected string $chavePrimaria = 'id';

    public function __construct()
    {
        $this->db = Database::conectar();
    }

    public function encontrarPorId(int $id): array|false
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->tabela} WHERE {$this->chavePrimaria} = :id LIMIT 1");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public function todos(string $ordenarPor = null): array
    {
        $sql = "SELECT * FROM {$this->tabela}";
        if ($ordenarPor) {
            $sql .= " ORDER BY {$ordenarPor}";
        }
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }

    public function excluir(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM {$this->tabela} WHERE {$this->chavePrimaria} = :id");
        return $stmt->execute(['id' => $id]);
    }

    /**
     * Insere um registo a partir de um array associativo [coluna => valor]
     * e devolve o ID inserido.
     */
    protected function inserir(array $dados): int
    {
        $colunas = implode(', ', array_keys($dados));
        $placeholders = ':' . implode(', :', array_keys($dados));

        $stmt = $this->db->prepare("INSERT INTO {$this->tabela} ({$colunas}) VALUES ({$placeholders})");
        $stmt->execute($dados);

        return (int) $this->db->lastInsertId();
    }

    /**
     * Atualiza um registo pelo ID a partir de um array associativo [coluna => valor].
     */
    protected function atualizar(int $id, array $dados): bool
    {
        $set = [];
        foreach (array_keys($dados) as $coluna) {
            $set[] = "{$coluna} = :{$coluna}";
        }
        $setSql = implode(', ', $set);

        $dados['id_where'] = $id;

        $stmt = $this->db->prepare(
            "UPDATE {$this->tabela} SET {$setSql} WHERE {$this->chavePrimaria} = :id_where"
        );

        return $stmt->execute($dados);
    }
}
