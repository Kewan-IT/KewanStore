<?php

/**
 * Funções auxiliares globais, disponíveis em toda a aplicação
 * (views, controllers, services).
 */

function formatarMoeda(float $valor): string
{
    return number_format($valor, 2, ',', '.') . ' MZN';
}

function formatarData(string $data, string $formato = 'd/m/Y'): string
{
    if (empty($data) || $data === '0000-00-00') {
        return '-';
    }
    return (new DateTime($data))->format($formato);
}

function formatarDataHora(string $dataHora): string
{
    return formatarData($dataHora, 'd/m/Y H:i');
}

function urlAtual(): string
{
    return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
}

function ativo(string $rota): string
{
    return str_starts_with(urlAtual(), $rota) ? 'active' : '';
}

function e(?string $valor): string
{
    return htmlspecialchars($valor ?? '', ENT_QUOTES, 'UTF-8');
}

function url(string $rota = ''): string
{
    $rota = ltrim($rota, '/');

    return $rota === '' ? '/' : '/' . $rota;
}

/**
 * Recupera e limpa a mensagem flash da sessão (usado após redirects).
 */
function flash(): ?array
{
    if (isset($_SESSION['flash'])) {
        $mensagem = $_SESSION['flash'];
        unset($_SESSION['flash']);
        return $mensagem;
    }
    return null;
}
