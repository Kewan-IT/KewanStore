<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Database;

class TesteController extends Controller
{
    public function index(): void
    {
        // Testa a conexão com a base de dados
        try {
            $db = Database::conectar();
            $stmt = $db->query('SELECT COUNT(*) AS total FROM produtos');
            $totalProdutos = $stmt->fetch()['total'];
            $statusBd = "Conexão OK — {$totalProdutos} produto(s) na base de dados.";
        } catch (\Throwable $e) {
            $statusBd = 'Erro de conexão: ' . $e->getMessage();
        }

        echo '<!DOCTYPE html><html lang="pt"><head><meta charset="UTF-8">';
        echo '<title>KewanStore — Teste do Núcleo</title></head><body style="font-family: sans-serif; padding: 2rem;">';
        echo '<h1>KewanStore</h1>';
        echo '<p><strong>Núcleo MVC:</strong> a funcionar ✅</p>';
        echo '<p><strong>Base de dados:</strong> ' . htmlspecialchars($statusBd) . '</p>';
        echo '</body></html>';
    }
}
