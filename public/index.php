<?php

/**
 * Front Controller — ponto de entrada único da aplicação.
 * Todas as requisições passam por aqui (via .htaccess ou php -S com router).
 */

// --------------------------------------------------
// Configuração de erros (ajusta conforme config/config.php -> debug)
// --------------------------------------------------
error_reporting(E_ALL);
ini_set('display_errors', '1');

// --------------------------------------------------
// Autoloader manual (sem Composer)
// Mapeia o namespace App\ para a pasta app/, seguindo PSR-4 simplificado
// --------------------------------------------------
spl_autoload_register(function (string $classe) {
    $prefixo = 'App\\';
    $diretorioBase = dirname(__DIR__) . '/app/';

    if (!str_starts_with($classe, $prefixo)) {
        return;
    }

    $classeRelativa = substr($classe, strlen($prefixo));
    $caminho = $diretorioBase . str_replace('\\', '/', $classeRelativa) . '.php';

    if (file_exists($caminho)) {
        require $caminho;
    }
});

// --------------------------------------------------
// Helpers globais
// --------------------------------------------------
require dirname(__DIR__) . '/app/Helpers/functions.php';

// --------------------------------------------------
// Configuração geral (timezone, etc.)
// --------------------------------------------------
$config = require dirname(__DIR__) . '/config/config.php';
date_default_timezone_set($config['timezone']);

// --------------------------------------------------
// Sessão
// --------------------------------------------------
App\Core\Auth::iniciarSessao();

// --------------------------------------------------
// Rotas
// --------------------------------------------------
$router = require dirname(__DIR__) . '/routes/web.php';
$router->despachar();
