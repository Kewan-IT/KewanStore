<?php
// Sidebar do projeto
?>
<aside class="sidebar">
    <div class="sidebar-menu">
        <ul>
            <li><a href="<?php echo url('dashboard'); ?>">Dashboard</a></li>
            <li>
                <span class="menu-title">Gerenciamento</span>
                <ul class="submenu">
                    <li><a href="<?php echo url('produtos'); ?>">Produtos</a></li>
                    <li><a href="<?php echo url('categorias'); ?>">Categorias</a></li>
                    <li><a href="<?php echo url('fornecedores'); ?>">Fornecedores</a></li>
                    <li><a href="<?php echo url('clientes'); ?>">Clientes</a></li>
                </ul>
            </li>
            <li>
                <span class="menu-title">Vendas</span>
                <ul class="submenu">
                    <li><a href="<?php echo url('vendas/pdv'); ?>">PDV</a></li>
                    <li><a href="<?php echo url('vendas'); ?>">Histórico</a></li>
                </ul>
            </li>
            <li>
                <span class="menu-title">Compras</span>
                <ul class="submenu">
                    <li><a href="<?php echo url('compras'); ?>">Compras</a></li>
                    <li><a href="<?php echo url('estoque'); ?>">Estoque</a></li>
                </ul>
            </li>
            <li><a href="<?php echo url('caixa'); ?>">Caixa</a></li>
            <li><a href="<?php echo url('relatorios'); ?>">Relatórios</a></li>
            <li><a href="<?php echo url('usuarios'); ?>">Usuários</a></li>
            <li><a href="<?php echo url('configuracoes'); ?>">Configurações</a></li>
        </ul>
    </div>
</aside>
