<?php
// Header do projeto
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?? 'KewanStore'; ?></title>
    <link rel="stylesheet" href="<?php echo url('assets/css/style.css'); ?>">
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="container">
                <div class="navbar-brand">
                    <h1>KewanStore</h1>
                </div>
                <ul class="navbar-menu">
                    <li><a href="<?php echo url('dashboard'); ?>">Dashboard</a></li>
                    <li><a href="<?php echo url('produtos'); ?>">Produtos</a></li>
                    <li><a href="<?php echo url('vendas'); ?>">Vendas</a></li>
                    <li><a href="<?php echo url('logout'); ?>">Sair</a></li>
                </ul>
            </div>
        </nav>
    </header>
