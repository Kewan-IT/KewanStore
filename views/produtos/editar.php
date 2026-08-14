<?php
// Página para editar produto
?>

    <div class="container">
        <h1>Editar Produto</h1>
        
        <?php if (isset($produto)): ?>
        <form method="POST" action="<?php echo url("produtos/editar/{$produto['id']}"); ?>" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" value="<?php echo $produto['nome']; ?>" required>
            </div>
            
            <div class="form-group">
                <label for="descricao">Descrição:</label>
                <textarea id="descricao" name="descricao"><?php echo $produto['descricao']; ?></textarea>
            </div>
            
            <div class="form-group">
                <label for="preco">Preço:</label>
                <input type="number" id="preco" name="preco" step="0.01" value="<?php echo $produto['preco']; ?>" required>
            </div>
            
            <button type="submit" class="btn btn-primary">Atualizar Produto</button>
            <a href="<?php echo url('produtos'); ?>" class="btn btn-secondary">Cancelar</a>
        </form>
        <?php endif; ?>
    </div>

