<?php
// Página de relatórios (placeholder)
?>
<?php include 'layouts/header.php'; ?>
<?php include 'layouts/sidebar.php'; ?>

<main class="main-content">
    <div class="container">
        <h1>Relatórios</h1>
        
        <div class="relatorios-grid">
            <div class="relatorio-card">
                <h3>Relatório de Vendas</h3>
                <a href="<?php echo url('relatorios/vendas'); ?>" class="btn btn-primary">Ver Relatório</a>
            </div>
            
            <div class="relatorio-card">
                <h3>Relatório de Estoque</h3>
                <a href="<?php echo url('relatorios/estoque'); ?>" class="btn btn-primary">Ver Relatório</a>
            </div>
            
            <div class="relatorio-card">
                <h3>Relatório Financeiro</h3>
                <a href="<?php echo url('relatorios/financeiro'); ?>" class="btn btn-primary">Ver Relatório</a>
            </div>
            
            <div class="relatorio-card">
                <h3>Relatório de Compras</h3>
                <a href="<?php echo url('relatorios/compras'); ?>" class="btn btn-primary">Ver Relatório</a>
            </div>
        </div>
    </div>
</main>

<?php include 'layouts/footer.php'; ?>
