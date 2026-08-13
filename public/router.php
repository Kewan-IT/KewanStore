<?php

/**
 * Router para o servidor embutido do PHP (php -S).
 * Uso: php -S localhost:8000 -t public public/router.php
 *
 * O servidor embutido não lê .htaccess, por isso este script
 * decide: se o pedido corresponde a um ficheiro real (CSS, JS, imagem),
 * serve-o diretamente; caso contrário, encaminha para index.php.
 */

$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$caminhoFicheiro = __DIR__ . $uri;

if ($uri !== '/' && file_exists($caminhoFicheiro) && !is_dir($caminhoFicheiro)) {
    return false; // Deixa o servidor embutido servir o ficheiro estático diretamente
}

require __DIR__ . '/index.php';
