<?php
// Página de configurações (placeholder)
?>

    <div class="container">
        <h1>Configurações</h1>
        
        <form method="POST" action="<?php echo url('configuracoes'); ?>">
            <div class="form-group">
                <label for="nome-loja">Nome da Loja:</label>
                <input type="text" id="nome-loja" name="nome_loja" required>
            </div>
            
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            
            <div class="form-group">
                <label for="telefone">Telefone:</label>
                <input type="tel" id="telefone" name="telefone">
            </div>
            
            <button type="submit" class="btn btn-primary">Salvar Configurações</button>
        </form>
    </div>

