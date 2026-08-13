<?php

namespace App\Core;

/**
 * Router minimalista, sem dependências externas.
 * Suporta GET/POST, parâmetros dinâmicos ({id}) e agrupamento
 * implícito por prefixo de URL.
 */
class Router
{
    private array $rotas = [
        'GET'  => [],
        'POST' => [],
    ];

    public function get(string $rota, string $controllerAcao): void
    {
        $this->rotas['GET'][$this->normalizar($rota)] = $controllerAcao;
    }

    public function post(string $rota, string $controllerAcao): void
    {
        $this->rotas['POST'][$this->normalizar($rota)] = $controllerAcao;
    }

    private function normalizar(string $rota): string
    {
        $rota = '/' . trim($rota, '/');
        return $rota === '/' ? '/' : rtrim($rota, '/');
    }

    public function despachar(): void
    {
        $metodo = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri = $this->normalizar($uri);

        foreach ($this->rotas[$metodo] ?? [] as $padrao => $controllerAcao) {
            $parametros = $this->corresponde($padrao, $uri);

            if ($parametros !== null) {
                $this->executar($controllerAcao, $parametros);
                return;
            }
        }

        http_response_code(404);
        $caminhoView404 = dirname(__DIR__, 2) . '/views/erros/404.php';
        if (file_exists($caminhoView404)) {
            require $caminhoView404;
        } else {
            echo '404 - Página não encontrada';
        }
    }

    /**
     * Verifica se a URI corresponde ao padrão da rota.
     * Suporta parâmetros dinâmicos no formato {nome}.
     * Devolve o array de parâmetros extraídos, ou null se não corresponder.
     */
    private function corresponde(string $padrao, string $uri): ?array
    {
        $segmentosPadrao = explode('/', trim($padrao, '/'));
        $segmentosUri = explode('/', trim($uri, '/'));

        if (count($segmentosPadrao) !== count($segmentosUri)) {
            return null;
        }

        $parametros = [];

        foreach ($segmentosPadrao as $i => $segmento) {
            if (preg_match('/^\{(\w+)\}$/', $segmento, $matches)) {
                $parametros[$matches[1]] = $segmentosUri[$i];
            } elseif ($segmento !== $segmentosUri[$i]) {
                return null;
            }
        }

        return $parametros;
    }

    private function executar(string $controllerAcao, array $parametros): void
    {
        [$controller, $acao] = explode('@', $controllerAcao);
        $classeCompleta = "App\\Controllers\\{$controller}";

        if (!class_exists($classeCompleta)) {
            http_response_code(500);
            die("Controller não encontrado: {$classeCompleta}");
        }

        $instancia = new $classeCompleta();

        if (!method_exists($instancia, $acao)) {
            http_response_code(500);
            die("Ação não encontrada: {$controller}@{$acao}");
        }

        call_user_func_array([$instancia, $acao], $parametros);
    }
}
