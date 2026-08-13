<?php
// Página para fechar caixa
?>
<?php include 'layouts/header.php'; ?>
<?php include 'layouts/sidebar.php'; ?>

<main class="main-content">
    <div class="container">
        <h1>Fechar Caixa</h1>
        
        <div class="caixa-info">
            <div class="info-box">
                <h3>Informações do Caixa</h3>
                <p><strong>Valor de Abertura:</strong> R$ <?php echo $caixa['valor_abertura'] ?? '0,00'; ?></p>
                <p><strong>Horário de Abertura:</strong> <?php echo $caixa['data_abertura'] ?? '-'; ?></p>
            </div>
        </div>
        
        <form method="POST" action="<?php echo url('caixa/fechar'); ?>">
            <div class="form-group">
                <label for="valor-fechamento">Valor de Fechamento:</label>
                <input type="number" id="valor-fechamento" name="valor_fechamento" step="0.01" required>
            </div>
            
            <div class="form-group">
                <label for="observacoes">Observações:</label>
                <textarea id="observacoes" name="observacoes"></textarea>
            </div>
            
            <button type="submit" class="btn btn-primary">Fechar Caixa</button>
            <a href="<?php echo url('caixa'); ?>" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</main>

<?php include 'layouts/footer.php'; ?>
