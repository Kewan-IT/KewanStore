<?php
// Página de lista de produtos
?>
<?php include 'layouts/header.php'; ?>
<?php include 'layouts/sidebar.php'; ?>

<main class="main-content">
    <div class="container">
        <h1>Produtos</h1>
        
        <div class="actions">
            <a href="<?php echo url('produtos/criar'); ?>" class="btn btn-primary">Novo Produto</a>
        </div>
        
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Categoria</th>
                    <th>Preço</th>
                    <th>Quantidade</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if (isset($produtos)): ?>
                    <?php foreach ($produtos as $produto): ?>
                        <tr>
                            <td><?php echo $produto['id']; ?></td>
                            <td><?php echo $produto['nome']; ?></td>
                            <td><?php echo $produto['categoria_id']; ?></td>
                            <td>R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></td>
                            <td><?php echo $produto['quantidade']; ?></td>
                            <td>
                                <a href="<?php echo url("produtos/editar/{$produto['id']}"); ?>" class="btn btn-sm btn-warning">Editar</a>
                                <a href="<?php echo url("produtos/deletar/{$produto['id']}"); ?>" class="btn btn-sm btn-danger">Deletar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</main>

<?php include 'layouts/footer.php'; ?>
