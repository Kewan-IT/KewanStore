<?php

// Configurações gerais da aplicação

return [
    'app_name' => 'KewanStore',
    'app_url'  => 'http://localhost:8000',
    'timezone' => 'Africa/Maputo',

    // Caminho absoluto da raiz do projeto (fora de public/)
    'base_path' => dirname(__DIR__),

    // Diretório de uploads (imagens de produtos, logotipo, etc.)
    'upload_path' => dirname(__DIR__) . '/public/assets/img/uploads',
    'upload_url'  => '/assets/img/uploads',

    // Ativa mensagens de erro detalhadas (desativar em produção)
    'debug' => true,
];
