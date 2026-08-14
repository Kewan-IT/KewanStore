<?php
// Página de histórico de vendas
?>

    <div class="container">
        <h1>Histórico de Vendas</h1>
        
        <div class="filters">
            <input type="date" id="data-inicio" placeholder="Data Início">
            <input type="date" id="data-fim" placeholder="Data Fim">
            <button class="btn btn-primary">Filtrar</button>
        </div>
        
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Data</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if (isset($vendas)): ?>
                    <?php foreach ($vendas as $venda): ?>
                        <tr>
                            <td><?php echo $venda['id']; ?></td>
                            <td><?php echo $venda['cliente_id']; ?></td>
                            <td><?php echo date('d/m/Y', strtotime($venda['data_venda'])); ?></td>
                            <td>R$ <?php echo number_format($venda['total'], 2, ',', '.'); ?></td>
                            <td><?php echo $venda['status']; ?></td>
                            <td>
                                <a href="#" class="btn btn-sm btn-info">Detalhes</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

