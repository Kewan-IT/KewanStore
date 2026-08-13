-- =====================================================
-- KewanStore - Schema da Base de Dados
-- Sistema de gestão para loja de produtos de primeira necessidade
-- =====================================================

SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------
-- USUÁRIOS E PERMISSÕES
-- ---------------------------------------------------
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    perfil ENUM('admin', 'caixa', 'estoquista') NOT NULL DEFAULT 'caixa',
    foto VARCHAR(255) DEFAULT NULL,
    ativo TINYINT(1) NOT NULL DEFAULT 1,
    ultimo_login DATETIME DEFAULT NULL,
    criado_em DATETIME DEFAULT CURRENT_TIMESTAMP,
    atualizado_em DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---------------------------------------------------
-- CONFIGURAÇÕES DO SISTEMA
-- ---------------------------------------------------
CREATE TABLE IF NOT EXISTS configuracoes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome_loja VARCHAR(150) NOT NULL DEFAULT 'KewanStore',
    logotipo VARCHAR(255) DEFAULT NULL,
    endereco VARCHAR(255) DEFAULT NULL,
    telefone VARCHAR(50) DEFAULT NULL,
    email VARCHAR(150) DEFAULT NULL,
    nuit VARCHAR(50) DEFAULT NULL,
    moeda VARCHAR(10) NOT NULL DEFAULT 'MZN',
    permite_venda_abaixo_estoque TINYINT(1) NOT NULL DEFAULT 0,
    dias_alerta_validade INT NOT NULL DEFAULT 30,
    estoque_minimo_padrao INT NOT NULL DEFAULT 5,
    atualizado_em DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---------------------------------------------------
-- CATEGORIAS
-- ---------------------------------------------------
CREATE TABLE IF NOT EXISTS categorias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    descricao VARCHAR(255) DEFAULT NULL,
    ativo TINYINT(1) NOT NULL DEFAULT 1,
    criado_em DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---------------------------------------------------
-- FORNECEDORES
-- ---------------------------------------------------
CREATE TABLE IF NOT EXISTS fornecedores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(150) NOT NULL,
    contacto VARCHAR(100) DEFAULT NULL,
    telefone VARCHAR(50) DEFAULT NULL,
    email VARCHAR(150) DEFAULT NULL,
    endereco VARCHAR(255) DEFAULT NULL,
    nuit VARCHAR(50) DEFAULT NULL,
    observacoes TEXT DEFAULT NULL,
    ativo TINYINT(1) NOT NULL DEFAULT 1,
    criado_em DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---------------------------------------------------
-- PRODUTOS
-- controla_validade = 0 -> stock simples (só quantidade em `estoque_atual`)
-- controla_validade = 1 -> stock controlado por lote (tabela produto_lotes),
--                           `estoque_atual` passa a ser a soma dos lotes
-- ---------------------------------------------------
CREATE TABLE IF NOT EXISTS produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    categoria_id INT DEFAULT NULL,
    nome VARCHAR(150) NOT NULL,
    codigo_barras VARCHAR(50) DEFAULT NULL,
    unidade_medida ENUM('unidade', 'kg', 'g', 'litro', 'ml', 'pacote', 'caixa') NOT NULL DEFAULT 'unidade',
    preco_custo DECIMAL(12,2) NOT NULL DEFAULT 0.00,
    preco_venda DECIMAL(12,2) NOT NULL DEFAULT 0.00,
    estoque_atual DECIMAL(12,2) NOT NULL DEFAULT 0,
    estoque_minimo DECIMAL(12,2) NOT NULL DEFAULT 5,
    controla_validade TINYINT(1) NOT NULL DEFAULT 0,
    imagem VARCHAR(255) DEFAULT NULL,
    ativo TINYINT(1) NOT NULL DEFAULT 1,
    criado_em DATETIME DEFAULT CURRENT_TIMESTAMP,
    atualizado_em DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE KEY uq_codigo_barras (codigo_barras),
    KEY idx_produtos_categoria (categoria_id),
    KEY idx_produtos_nome (nome),
    CONSTRAINT fk_produtos_categoria FOREIGN KEY (categoria_id) REFERENCES categorias(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---------------------------------------------------
-- LOTES DE PRODUTO (para produtos com controla_validade = 1)
-- Suporta FEFO (First Expire, First Out) no PDV
-- ---------------------------------------------------
CREATE TABLE IF NOT EXISTS produto_lotes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    produto_id INT NOT NULL,
    numero_lote VARCHAR(50) DEFAULT NULL,
    quantidade DECIMAL(12,2) NOT NULL DEFAULT 0,
    data_validade DATE NOT NULL,
    preco_custo DECIMAL(12,2) DEFAULT NULL,
    preco_promocional DECIMAL(12,2) DEFAULT NULL,
    criado_em DATETIME DEFAULT CURRENT_TIMESTAMP,
    KEY idx_lotes_produto (produto_id),
    KEY idx_lotes_validade (data_validade),
    CONSTRAINT fk_lotes_produto FOREIGN KEY (produto_id) REFERENCES produtos(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---------------------------------------------------
-- CLIENTES (com saldo devedor para vendas a fiado)
-- ---------------------------------------------------
CREATE TABLE IF NOT EXISTS clientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(150) NOT NULL,
    telefone VARCHAR(50) DEFAULT NULL,
    email VARCHAR(150) DEFAULT NULL,
    endereco VARCHAR(255) DEFAULT NULL,
    documento_identificacao VARCHAR(50) DEFAULT NULL,
    limite_credito DECIMAL(12,2) NOT NULL DEFAULT 0.00,
    saldo_devedor DECIMAL(12,2) NOT NULL DEFAULT 0.00,
    ativo TINYINT(1) NOT NULL DEFAULT 1,
    criado_em DATETIME DEFAULT CURRENT_TIMESTAMP,
    KEY idx_clientes_nome (nome)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---------------------------------------------------
-- CAIXA (abertura/fecho de sessão de caixa)
-- ---------------------------------------------------
CREATE TABLE IF NOT EXISTS caixa (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    valor_abertura DECIMAL(12,2) NOT NULL DEFAULT 0.00,
    valor_fechamento DECIMAL(12,2) DEFAULT NULL,
    valor_esperado DECIMAL(12,2) DEFAULT NULL,
    diferenca DECIMAL(12,2) DEFAULT NULL,
    observacoes TEXT DEFAULT NULL,
    status ENUM('aberto', 'fechado') NOT NULL DEFAULT 'aberto',
    aberto_em DATETIME DEFAULT CURRENT_TIMESTAMP,
    fechado_em DATETIME DEFAULT NULL,
    KEY idx_caixa_usuario (usuario_id),
    KEY idx_caixa_status (status),
    CONSTRAINT fk_caixa_usuario FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---------------------------------------------------
-- VENDAS
-- ---------------------------------------------------
CREATE TABLE IF NOT EXISTS vendas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    caixa_id INT NOT NULL,
    usuario_id INT NOT NULL,
    cliente_id INT DEFAULT NULL,
    numero_venda VARCHAR(30) NOT NULL,
    subtotal DECIMAL(12,2) NOT NULL DEFAULT 0.00,
    desconto DECIMAL(12,2) NOT NULL DEFAULT 0.00,
    total DECIMAL(12,2) NOT NULL DEFAULT 0.00,
    forma_pagamento ENUM('dinheiro', 'mpesa', 'emola', 'cartao', 'fiado') NOT NULL DEFAULT 'dinheiro',
    valor_pago DECIMAL(12,2) NOT NULL DEFAULT 0.00,
    troco DECIMAL(12,2) NOT NULL DEFAULT 0.00,
    status ENUM('concluida', 'cancelada', 'devolvida_parcial', 'devolvida_total') NOT NULL DEFAULT 'concluida',
    criado_em DATETIME DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY uq_numero_venda (numero_venda),
    KEY idx_vendas_caixa (caixa_id),
    KEY idx_vendas_usuario (usuario_id),
    KEY idx_vendas_cliente (cliente_id),
    KEY idx_vendas_data (criado_em),
    CONSTRAINT fk_vendas_caixa FOREIGN KEY (caixa_id) REFERENCES caixa(id),
    CONSTRAINT fk_vendas_usuario FOREIGN KEY (usuario_id) REFERENCES usuarios(id),
    CONSTRAINT fk_vendas_cliente FOREIGN KEY (cliente_id) REFERENCES clientes(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---------------------------------------------------
-- ITENS DA VENDA
-- ---------------------------------------------------
CREATE TABLE IF NOT EXISTS venda_itens (
    id INT AUTO_INCREMENT PRIMARY KEY,
    venda_id INT NOT NULL,
    produto_id INT NOT NULL,
    lote_id INT DEFAULT NULL,
    quantidade DECIMAL(12,2) NOT NULL,
    preco_unitario DECIMAL(12,2) NOT NULL,
    desconto DECIMAL(12,2) NOT NULL DEFAULT 0.00,
    subtotal DECIMAL(12,2) NOT NULL,
    KEY idx_itens_venda (venda_id),
    KEY idx_itens_produto (produto_id),
    KEY idx_itens_lote (lote_id),
    CONSTRAINT fk_itens_venda FOREIGN KEY (venda_id) REFERENCES vendas(id) ON DELETE CASCADE,
    CONSTRAINT fk_itens_produto FOREIGN KEY (produto_id) REFERENCES produtos(id),
    CONSTRAINT fk_itens_lote FOREIGN KEY (lote_id) REFERENCES produto_lotes(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---------------------------------------------------
-- PAGAMENTOS DE FIADO (abatimento do saldo devedor do cliente)
-- ---------------------------------------------------
CREATE TABLE IF NOT EXISTS pagamentos_fiado (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cliente_id INT NOT NULL,
    venda_id INT DEFAULT NULL,
    usuario_id INT NOT NULL,
    valor DECIMAL(12,2) NOT NULL,
    forma_pagamento ENUM('dinheiro', 'mpesa', 'emola', 'cartao') NOT NULL DEFAULT 'dinheiro',
    observacoes VARCHAR(255) DEFAULT NULL,
    criado_em DATETIME DEFAULT CURRENT_TIMESTAMP,
    KEY idx_pagamentos_cliente (cliente_id),
    KEY idx_pagamentos_venda (venda_id),
    CONSTRAINT fk_pagamentos_cliente FOREIGN KEY (cliente_id) REFERENCES clientes(id),
    CONSTRAINT fk_pagamentos_venda FOREIGN KEY (venda_id) REFERENCES vendas(id),
    CONSTRAINT fk_pagamentos_usuario FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---------------------------------------------------
-- COMPRAS (entradas de mercadoria)
-- ---------------------------------------------------
CREATE TABLE IF NOT EXISTS compras (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fornecedor_id INT NOT NULL,
    usuario_id INT NOT NULL,
    numero_documento VARCHAR(50) DEFAULT NULL,
    subtotal DECIMAL(12,2) NOT NULL DEFAULT 0.00,
    desconto DECIMAL(12,2) NOT NULL DEFAULT 0.00,
    total DECIMAL(12,2) NOT NULL DEFAULT 0.00,
    status ENUM('pendente', 'recebida', 'cancelada') NOT NULL DEFAULT 'recebida',
    observacoes TEXT DEFAULT NULL,
    criado_em DATETIME DEFAULT CURRENT_TIMESTAMP,
    KEY idx_compras_fornecedor (fornecedor_id),
    KEY idx_compras_usuario (usuario_id),
    CONSTRAINT fk_compras_fornecedor FOREIGN KEY (fornecedor_id) REFERENCES fornecedores(id),
    CONSTRAINT fk_compras_usuario FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---------------------------------------------------
-- ITENS DA COMPRA
-- ---------------------------------------------------
CREATE TABLE IF NOT EXISTS compra_itens (
    id INT AUTO_INCREMENT PRIMARY KEY,
    compra_id INT NOT NULL,
    produto_id INT NOT NULL,
    lote_id INT DEFAULT NULL,
    quantidade DECIMAL(12,2) NOT NULL,
    preco_custo_unitario DECIMAL(12,2) NOT NULL,
    subtotal DECIMAL(12,2) NOT NULL,
    KEY idx_compra_itens_compra (compra_id),
    KEY idx_compra_itens_produto (produto_id),
    CONSTRAINT fk_compra_itens_compra FOREIGN KEY (compra_id) REFERENCES compras(id) ON DELETE CASCADE,
    CONSTRAINT fk_compra_itens_produto FOREIGN KEY (produto_id) REFERENCES produtos(id),
    CONSTRAINT fk_compra_itens_lote FOREIGN KEY (lote_id) REFERENCES produto_lotes(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---------------------------------------------------
-- MOVIMENTOS DE ESTOQUE (auditoria de ajustes/entradas/saídas)
-- ---------------------------------------------------
CREATE TABLE IF NOT EXISTS estoque_movimentos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    produto_id INT NOT NULL,
    lote_id INT DEFAULT NULL,
    usuario_id INT NOT NULL,
    tipo ENUM('entrada', 'saida', 'ajuste', 'devolucao') NOT NULL,
    quantidade DECIMAL(12,2) NOT NULL,
    quantidade_anterior DECIMAL(12,2) NOT NULL,
    quantidade_atual DECIMAL(12,2) NOT NULL,
    motivo VARCHAR(255) DEFAULT NULL,
    referencia_tipo VARCHAR(30) DEFAULT NULL COMMENT 'venda, compra, ajuste_manual',
    referencia_id INT DEFAULT NULL,
    criado_em DATETIME DEFAULT CURRENT_TIMESTAMP,
    KEY idx_estoque_mov_produto (produto_id),
    KEY idx_estoque_mov_data (criado_em),
    CONSTRAINT fk_estoque_mov_produto FOREIGN KEY (produto_id) REFERENCES produtos(id),
    CONSTRAINT fk_estoque_mov_usuario FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---------------------------------------------------
-- NOTIFICAÇÕES (sino de alertas, estoque baixo/validade próxima)
-- ---------------------------------------------------
CREATE TABLE IF NOT EXISTS notificacoes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tipo ENUM('estoque_baixo', 'validade_proxima', 'sistema') NOT NULL,
    titulo VARCHAR(150) NOT NULL,
    mensagem VARCHAR(255) NOT NULL,
    referencia_id INT DEFAULT NULL,
    lida TINYINT(1) NOT NULL DEFAULT 0,
    criado_em DATETIME DEFAULT CURRENT_TIMESTAMP,
    KEY idx_notif_lida (lida)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

SET FOREIGN_KEY_CHECKS = 1;

-- ---------------------------------------------------
-- DADOS INICIAIS
-- ---------------------------------------------------
INSERT INTO configuracoes (nome_loja, moeda) VALUES ('KewanStore', 'MZN');

INSERT INTO usuarios (nome, email, senha, perfil) VALUES
('Administrador', 'admin@kewanstore.mz', '$2y$10$92IXUNpkjO0rOQ5byMi.YeIvB8gEZWlaJmVOG.KgJmB0OeE1p5oIC', 'admin');
-- senha padrão do hash acima: "password" -- ALTERAR no primeiro login

INSERT INTO categorias (nome, descricao) VALUES
('Alimentos', 'Produtos alimentares em geral'),
('Bebidas', 'Bebidas com e sem álcool'),
('Higiene Pessoal', 'Produtos de higiene e cuidado pessoal'),
('Limpeza', 'Produtos de limpeza doméstica'),
('Diversos', 'Outros produtos de primeira necessidade');
