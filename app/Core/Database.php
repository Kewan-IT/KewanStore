<?php

namespace App\Core;

use PDO;
use PDOException;

/**
 * Gerencia a conexão PDO com a base de dados, seguindo o padrão Singleton
 * para garantir uma única conexão reutilizada em toda a aplicação.
 */
class Database
{
    private static ?PDO $instancia = null;

    private function __construct()
    {
        // Construtor privado — impede instanciação direta
    }

    public static function conectar(): PDO
    {
        if (self::$instancia === null) {
            $config = require dirname(__DIR__, 2) . '/config/database.php';

            $dsn = sprintf(
                'mysql:host=%s;port=%s;dbname=%s;charset=%s',
                $config['host'],
                $config['port'],
                $config['database'],
                $config['charset']
            );

            try {
                self::$instancia = new PDO($dsn, $config['username'], $config['password'], [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES   => false,
                ]);
            } catch (PDOException $e) {
                // Em produção, isto deve ir para um log em vez de ecrã
                die('Erro de conexão à base de dados: ' . $e->getMessage());
            }
        }

        return self::$instancia;
    }

    // Impede clonagem da instância (mantém o singleton)
    private function __clone(): void
    {
    }
}
