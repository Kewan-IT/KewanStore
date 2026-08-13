<?php
// Página PDV - Ponto de Venda
?>
<?php include 'layouts/header.php'; ?>
<?php include 'layouts/sidebar.php'; ?>

<main class="main-content">
    <div class="container pdv-container">
        <h1>Ponto de Venda (PDV)</h1>
        
        <div class="pdv-layout">
            <div class="pdv-products">
                <h3>Produtos Disponíveis</h3>
                <input type="text" id="search-products" placeholder="Buscar produto..." class="search-input">
                <div class="products-list">
                    <!-- Produtos carregados via JavaScript -->
                </div>
            </div>
            
            <div class="pdv-cart">
                <h3>Carrinho de Vendas</h3>
                <table class="cart-table">
                    <thead>
                        <tr>
                            <th>Produto</th>
                            <th>Qtd</th>
                            <th>Preço</th>
                            <th>Subtotal</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <tbody id="cart-items">
                    </tbody>
                </table>
                
                <div class="cart-summary">
                    <div class="summary-row">
                        <span>Subtotal:</span>
                        <span id="subtotal">R$ 0,00</span>
                    </div>
                    <div class="summary-row">
                        <span>Desconto:</span>
                        <input type="number" id="discount" step="0.01" value="0">
                    </div>
                    <div class="summary-row total">
                        <span>Total:</span>
                        <span id="total">R$ 0,00</span>
                    </div>
                </div>
                
                <div class="cart-actions">
                    <button class="btn btn-primary btn-large">Finalizar Venda</button>
                    <button class="btn btn-secondary btn-large">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include 'layouts/footer.php'; ?>
