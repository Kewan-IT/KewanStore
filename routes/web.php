<?php

use App\Core\Router;

$router = new Router();

// --------------------------------------------------
// Dashboard principal
// --------------------------------------------------
$router->get('/', 'DashboardController@index');
$router->get('/dashboard', 'DashboardController@index');

// --------------------------------------------------
// Autenticação
// --------------------------------------------------
$router->get('/login', 'AuthController@loginForm');
$router->post('/login', 'AuthController@entrar');
$router->get('/logout', 'AuthController@sair');

// --------------------------------------------------
// Produtos
// --------------------------------------------------
// $router->get('/produtos', 'ProdutoController@index');
// $router->get('/produtos/criar', 'ProdutoController@criar');
// $router->post('/produtos', 'ProdutoController@guardar');
// $router->get('/produtos/{id}/editar', 'ProdutoController@editar');
// $router->post('/produtos/{id}', 'ProdutoController@atualizar');
// $router->post('/produtos/{id}/excluir', 'ProdutoController@excluir');

// --------------------------------------------------
// Vendas (PDV)
// --------------------------------------------------
// $router->get('/vendas', 'VendaController@pdv');
// $router->post('/vendas', 'VendaController@finalizar');

return $router;
