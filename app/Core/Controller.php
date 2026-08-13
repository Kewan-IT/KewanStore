<?php

namespace App\Core;

/**
 * Classe base para todos os Controllers. Fornece métodos auxiliares
 * comuns: renderizar views, redirecionar, responder em JSON e ler
 * dados de entrada (POST/GET) de forma consistente.
 */
abstract class Controller
{
    /**
     * Renderiza uma view dentro do layout padrão (header + sidebar + footer).
     *
     * @param string $view  Caminho da view relativo a /views, sem extensão. Ex: 'produtos/index'
     * @param array  $dados Variáveis a disponibilizar dentro da view
     */
    protected function view(string $view, array $dados = []): void
    {
        extract($dados);

        $caminhoView = dirname(__DIR__, 2) . "/views/{$view}.php";

        if (!file_exists($caminhoView)) {
            http_response_code(500);
            die("View não encontrada: {$view}");
        }

        require dirname(__DIR__, 2) . '/views/layouts/header.php';
        require dirname(__DIR__, 2) . '/views/layouts/sidebar.php';
        require $caminhoView;
        require dirname(__DIR__, 2) . '/views/layouts/footer.php';
    }

    /**
     * Renderiza uma view "solta", sem o layout (ex: página de login).
     */
    protected function viewSemLayout(string $view, array $dados = []): void
    {
        extract($dados);

        $caminhoView = dirname(__DIR__, 2) . "/views/{$view}.php";

        if (!file_exists($caminhoView)) {
            http_response_code(500);
            die("View não encontrada: {$view}");
        }

        require $caminhoView;
    }

    protected function redirecionar(string $url): void
    {
        header("Location: {$url}");
        exit;
    }

    protected function json(mixed $dados, int $codigo = 200): void
    {
        http_response_code($codigo);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($dados, JSON_UNESCAPED_UNICODE);
        exit;
    }

    /**
     * Lê dados de entrada (POST ou JSON no corpo da requisição),
     * já sanitizados com trim.
     */
    protected function entrada(string $chave, mixed $padrao = null): mixed
    {
        $dados = $_POST;

        // Suporta também requisições JSON (usadas pelo PDV/AJAX)
        if (empty($dados) && str_contains($_SERVER['CONTENT_TYPE'] ?? '', 'application/json')) {
            $dados = json_decode(file_get_contents('php://input'), true) ?? [];
        }

        $valor = $dados[$chave] ?? $padrao;

        return is_string($valor) ? trim($valor) : $valor;
    }

    protected function mensagemFlash(string $tipo, string $mensagem): void
    {
        $_SESSION['flash'] = ['tipo' => $tipo, 'mensagem' => $mensagem];
    }
}
