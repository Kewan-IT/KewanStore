<?php
// Página para abrir caixa
?>
<?php include 'layouts/header.php'; ?>
<?php include 'layouts/sidebar.php'; ?>

<main class="main-content">
    <div class="container">
        <h1>Abrir Caixa</h1>
        
        <form method="POST" action="<?php echo url('caixa/abrir'); ?>">
            <div class="form-group">
                <label for="valor-abertura">Valor de Abertura:</label>
                <input type="number" id="valor-abertura" name="valor_abertura" step="0.01" required>
            </div>
            
            <div class="form-group">
                <label for="observacoes">Observações:</label>
                <textarea id="observacoes" name="observacoes"></textarea>
            </div>
            
            <button type="submit" class="btn btn-primary">Abrir Caixa</button>
            <a href="<?php echo url('caixa'); ?>" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</main>

<?php include 'layouts/footer.php'; ?>
