-- Seeds iniciais do banco de dados KewanStore

INSERT INTO usuarios (nome, email, senha, perfil, ativo) VALUES
('Admin', 'admin@kewanstore.com', '$2y$10$...', 'admin', true),
('Gerente', 'gerente@kewanstore.com', '$2y$10$...', 'gerente', true),
('Vendedor', 'vendedor@kewanstore.com', '$2y$10$...', 'vendedor', true);

INSERT INTO categorias (nome, descricao) VALUES
('Eletrônicos', 'Produtos eletrônicos em geral'),
('Roupas', 'Roupas e acessórios'),
('Alimentos', 'Produtos alimentares'),
('Livros', 'Livros e publicações'),
('Higiene', 'Produtos de higiene e limpeza');

INSERT INTO fornecedores (nome, cnpj, email, telefone, endereco, cidade, estado) VALUES
('Fornecedor A', '12.345.678/0001-90', 'contato@fornecedora.com', '(11) 3000-0000', 'Rua A, 123', 'São Paulo', 'SP'),
('Fornecedor B', '98.765.432/0001-10', 'contato@fornecedorb.com', '(21) 2000-0000', 'Rua B, 456', 'Rio de Janeiro', 'RJ');

INSERT INTO produtos (nome, descricao, preco, categoria_id, fornecedor_id, quantidade, ativo) VALUES
('Notebook', 'Notebook de alta performance', 2500.00, 1, 1, 10, true),
('Monitor', 'Monitor 24 polegadas Full HD', 800.00, 1, 1, 15, true),
('Camiseta', 'Camiseta de algodão', 50.00, 2, 2, 100, true),
('Arroz', 'Arroz integral 5kg', 25.00, 3, 2, 50, true),
('Livro PHP', 'Aprenda PHP do zero', 150.00, 4, 1, 20, true);

INSERT INTO clientes (nome, cpf, email, telefone, endereco, cidade, estado) VALUES
('Cliente 1', '123.456.789-00', 'cliente1@email.com', '(11) 9000-0000', 'Rua X, 100', 'São Paulo', 'SP'),
('Cliente 2', '987.654.321-00', 'cliente2@email.com', '(21) 9000-0000', 'Rua Y, 200', 'Rio de Janeiro', 'RJ');

INSERT INTO configuracoes (chave, valor) VALUES
('nome_loja', 'KewanStore - Sua Loja Online'),
('email_loja', 'contato@kewanstore.com'),
('telefone_loja', '(11) 3000-0000'),
('endereco_loja', 'Rua Principal, 1000 - São Paulo, SP'),
('taxa_lucro_padrao', '30'),
('imposto_padrao', '15');
