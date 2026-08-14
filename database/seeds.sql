-- =====================================================
-- KewanStore - Dados de teste (seeds)
-- Alinhado com database/schema.sql — contexto moçambicano
-- Todas as senhas de teste: "password"
-- =====================================================

-- Nota: a tabela `usuarios` já recebe um admin via schema.sql.
-- Aqui acrescentamos utilizadores adicionais para os outros perfis.
INSERT INTO usuarios (nome, email, senha, perfil, ativo) VALUES
('Gestor da Loja', 'gestor@kewanstore.mz', '$2y$10$8K29irI5h3bHlL57noVY1enyu8ENZL48uPyUmYnzWX73oApLd9orm', 'admin', 1),
('Operador de Caixa', 'caixa@kewanstore.mz', '$2y$10$8K29irI5h3bHlL57noVY1enyu8ENZL48uPyUmYnzWX73oApLd9orm', 'caixa', 1),
('Estoquista', 'estoque@kewanstore.mz', '$2y$10$8K29irI5h3bHlL57noVY1enyu8ENZL48uPyUmYnzWX73oApLd9orm', 'estoquista', 1);

-- Nota: a tabela `categorias` já recebe 5 categorias base via schema.sql
-- (Alimentos, Bebidas, Higiene Pessoal, Limpeza, Diversos).

INSERT INTO fornecedores (nome, contacto, telefone, email, endereco, nuit, observacoes, ativo) VALUES
('Distribuidora Maputo Lda', 'Carlos Nhaca', '+258 84 123 4567', 'vendas@distmaputo.co.mz', 'Av. 24 de Julho, Maputo', '400123456', 'Fornecedor principal de mercearia', 1),
('Grossista Beira Comercial', 'Fátima Bila', '+258 82 987 6543', 'geral@beiracomercial.co.mz', 'Rua da Independência, Beira', '400654321', 'Bebidas e produtos de limpeza', 1);

-- Produtos: 2 com controlo de validade (lote), 3 sem (stock simples)
INSERT INTO produtos (categoria_id, nome, codigo_barras, unidade_medida, preco_custo, preco_venda, estoque_atual, estoque_minimo, controla_validade, ativo) VALUES
(1, 'Arroz 5kg', '7891000100103', 'pacote', 280.00, 350.00, 40, 10, 0, 1),
(1, 'Óleo Alimentar 750ml', '7891000100202', 'unidade', 95.00, 130.00, 0, 15, 1, 1),
(2, 'Água Mineral 1.5L', '7891000100301', 'unidade', 25.00, 40.00, 120, 20, 0, 1),
(3, 'Sabonete 90g', '7891000100400', 'unidade', 15.00, 25.00, 60, 10, 0, 1),
(1, 'Leite UHT 1L', '7891000100509', 'unidade', 55.00, 75.00, 0, 12, 1, 1);

-- Lotes para os produtos com controla_validade = 1 (Óleo id=2, Leite id=5)
INSERT INTO produto_lotes (produto_id, numero_lote, quantidade, data_validade, preco_custo) VALUES
(2, 'LT-2026-001', 24, '2026-12-15', 95.00),
(2, 'LT-2026-002', 18, '2027-02-28', 97.50),
(5, 'LT-2026-010', 30, '2026-09-30', 55.00);

-- Atualiza estoque_atual dos produtos com lote (soma dos lotes)
UPDATE produtos SET estoque_atual = 42 WHERE id = 2;
UPDATE produtos SET estoque_atual = 30 WHERE id = 5;

INSERT INTO clientes (nome, telefone, email, endereco, documento_identificacao, limite_credito, saldo_devedor, ativo) VALUES
('Maria Machava', '+258 84 111 2233', 'maria.machava@email.com', 'Bairro Central, Tete', '110203040', 1500.00, 350.00, 1),
('João Sitoe', '+258 82 444 5566', NULL, 'Bairro Chingale, Tete', '110506070', 800.00, 0.00, 1);
