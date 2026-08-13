# KewanStore - Sistema de Gerenciamento de Loja

Um sistema completo de gerenciamento de loja desenvolvido em PHP vanilla com arquitetura MVC.

## 📁 Estrutura do Projeto

```
KewanStore/
│
├── app/                          # Código-fonte da aplicação
│   ├── Controllers/             # Controladores da aplicação
│   │   ├── AuthController.php
│   │   ├── ProdutoController.php
│   │   ├── CategoriaController.php
│   │   ├── FornecedorController.php
│   │   ├── CompraController.php
│   │   ├── VendaController.php
│   │   ├── CaixaController.php
│   │   ├── ClienteController.php
│   │   ├── EstoqueController.php
│   │   ├── RelatorioController.php
│   │   ├── UsuarioController.php
│   │   └── ConfiguracaoController.php
│   │
│   ├── Models/                  # Modelos de dados
│   │   ├── Produto.php
│   │   ├── Categoria.php
│   │   ├── Fornecedor.php
│   │   ├── Compra.php
│   │   ├── Venda.php
│   │   ├── VendaItem.php
│   │   ├── Caixa.php
│   │   ├── Cliente.php
│   │   ├── Usuario.php
│   │   └── Configuracao.php
│   │
│   ├── Services/                # Serviços da aplicação
│   │   ├── UploadService.php
│   │   ├── BackupService.php
│   │   ├── EstoqueService.php
│   │   ├── PaginacaoService.php
│   │   └── NotificacaoService.php
│   │
│   ├── Core/                    # Classes base
│   │   ├── Database.php         # Conexão PDO
│   │   ├── Router.php           # Roteador
│   │   ├── Controller.php       # Classe base para controladores
│   │   ├── Model.php            # Classe base para modelos
│   │   └── Auth.php             # Autenticação
│   │
│   └── Helpers/                 # Funções auxiliares
│       ├── functions.php
│       └── Validacao.php
│
├── views/                       # Templates da aplicação
│   ├── layouts/
│   │   ├── header.php
│   │   ├── sidebar.php
│   │   └── footer.php
│   │
│   ├── auth/
│   │   └── login.php
│   │
│   ├── produtos/
│   │   ├── index.php
│   │   ├── criar.php
│   │   └── editar.php
│   │
│   ├── vendas/
│   │   ├── pdv.php              # Ponto de Venda
│   │   └── historico.php
│   │
│   ├── caixa/
│   │   ├── abrir.php
│   │   └── fechar.php
│   │
│   ├── relatorios/
│   └── configuracoes/
│
├── public/                      # Diretório público (raiz web)
│   ├── index.php               # Front Controller
│   ├── .htaccess
│   └── assets/
│       ├── css/
│       │   └── style.css
│       ├── js/
│       │   └── main.js
│       └── img/
│           └── uploads/
│               └── produtos/
│
├── config/                      # Arquivos de configuração
│   ├── database.php
│   └── config.php
│
├── database/                    # Scripts do banco de dados
│   ├── schema.sql              # Estrutura do banco
│   └── seeds.sql               # Dados iniciais
│
├── storage/                     # Armazenamento de dados
│   ├── backups/
│   └── logs/
│
├── routes/                      # Definições de rotas
│   └── web.php
│
├── vendor/                      # Dependências (Composer)
├── .gitignore
├── README.md
└── composer.json
```

## 🚀 Funcionalidades

### Gerenciamento de Produtos
- ✅ Listar produtos
- ✅ Criar novo produto
- ✅ Editar produto
- ✅ Deletar produto
- ✅ Gerenciamento de categorias
- ✅ Gerenciamento de fornecedores

### Vendas
- ✅ Ponto de Venda (PDV)
- ✅ Histórico de vendas
- ✅ Gerenciamento de clientes
- ✅ Cálculo automático de totais

### Compras
- ✅ Registro de compras
- ✅ Fornecedores
- ✅ Integração com estoque

### Caixa
- ✅ Abertura e fechamento de caixa
- ✅ Fluxo de caixa
- ✅ Relatório de movimentações

### Estoque
- ✅ Listagem de produtos
- ✅ Movimentação de estoque
- ✅ Ajustes de quantidade
- ✅ Histórico de movimentações

### Relatórios
- ✅ Relatório de vendas
- ✅ Relatório de estoque
- ✅ Relatório financeiro
- ✅ Relatório de compras

### Administração
- ✅ Gerenciamento de usuários
- ✅ Controle de perfis (admin, gerente, vendedor)
- ✅ Configurações gerais
- ✅ Backup do banco de dados

## 🔧 Requisitos

- PHP 7.4 ou superior
- MySQL 5.7 ou superior
- Apache com mod_rewrite ativado
- Composer (opcional, para gerenciar dependências)

## 📦 Instalação

### 1. Clonar o repositório
```bash
git clone https://github.com/Kewan-IT/KewanStore.git
cd KewanStore
```

### 2. Configurar banco de dados
- Editar `config/database.php` com suas credenciais
- Criar o banco de dados: `php database/schema.sql`
- (Opcional) Inserir dados iniciais: `php database/seeds.sql`

### 3. Instalar dependências (se usar Composer)
```bash
composer install
```

### 4. Configurar permissões
```bash
chmod -R 755 storage/
chmod -R 755 public/assets/img/uploads/
```

### 5. Configurar servidor web
Apontar o document root para a pasta `public/`

## 🔐 Segurança

- As senhas são armazenadas com hash bcrypt
- Implementar proteção contra CSRF
- Validar todas as entradas do usuário
- Usar prepared statements para queries SQL
- Manter as dependências atualizadas

## 📝 Notas de Desenvolvimento

- Todos os Controllers herdam de `Controller`
- Todos os Models herdam de `Model`
- Use os Services para lógica de negócio
- Implemente validação usando a classe `Validacao`
- As views usam a função `render()` ou `include`

## 📚 Estrutura de Perfis de Usuário

1. **Admin**: Acesso completo ao sistema
2. **Gerente**: Acesso a relatórios e configurações limitadas
3. **Vendedor**: Acesso apenas ao PDV e histórico de vendas
4. **Operacional**: Acesso limitado para operações de estoque

## 🐛 Debugging

Para ativar o modo debug, altere em `config/config.php`:
```php
'APP_DEBUG' => true
```

## 📖 Documentação de APIs

Endpoints básicos (descomentados em `routes/web.php`):

### Produtos
- `GET /api/produtos` - Listar todos
- `GET /api/produtos/{id}` - Detalhes
- `POST /api/produtos` - Criar
- `PUT /api/produtos/{id}` - Atualizar
- `DELETE /api/produtos/{id}` - Deletar

## 📧 Suporte

Para suporte, entre em contato através do email: contato@kewanstore.com

## 📄 Licença

Este projeto é licenciado sob a MIT License - veja o arquivo LICENSE para detalhes.

## 👨‍💻 Autor

Kewan-IT

---

**Última atualização**: 2024
