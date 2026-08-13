<?php
// Página para criar produto
?>
<?php include 'layouts/header.php'; ?>
<?php include 'layouts/sidebar.php'; ?>

<main class="main-content">
    <div class="container">
        <h1>Criar Novo Produto</h1>
        
        <form method="POST" action="<?php echo url('produtos/criar'); ?>" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" required>
            </div>
            
            <div class="form-group">
                <label for="descricao">Descrição:</label>
                <textarea id="descricao" name="descricao"></textarea>
            </div>
            
            <div class="form-group">
                <label for="preco">Preço:</label>
                <input type="number" id="preco" name="preco" step="0.01" required>
            </div>
            
            <div class="form-group">
                <label for="categoria_id">Categoria:</label>
                <select id="categoria_id" name="categoria_id" required>
                    <option value="">Selecione uma categoria</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="imagem">Imagem:</label>
                <input type="file" id="imagem" name="imagem" accept="image/*">
            </div>
            
            <button type="submit" class="btn btn-primary">Criar Produto</button>
            <a href="<?php echo url('produtos'); ?>" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</main>

<?php include 'layouts/footer.php'; ?>
