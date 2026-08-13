<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?? 'Login | KewanStore'; ?></title>
    <link rel="stylesheet" href="<?php echo url('assets/css/style.css'); ?>">
</head>
<body class="login-page-body">
    <div class="login-page">
        <div class="login-shell">
            <aside class="login-visual">
                <div class="brand-mark">
                    <span class="brand-icon">K</span>
                    <div>
                        <strong>KewanStore</strong>
                        <small>Mercado & suporte diário</small>
                    </div>
                </div>

                <div class="visual-copy">
                    <p class="eyebrow">Sistema de gestão</p>
                    <h1>Controle inteligente da sua loja de primeira necessidade.</h1>
                    <p>
                        Acompanhe vendas, estoque, caixa e operações diárias com agilidade,
                        segurança e organização em um único painel.
                    </p>
                </div>

                <div class="access-levels">
                    <div class="level-item level-admin">
                        <span class="level-tag">Admin</span>
                        <strong>Gestão total</strong>
                    </div>
                    <div class="level-item level-cashier">
                        <span class="level-tag">Caixa</span>
                        <strong>Vendas rápidas</strong>
                    </div>
                    <div class="level-item level-stock">
                        <span class="level-tag">Estoquista</span>
                        <strong>Controle de estoque</strong>
                    </div>
                </div>
            </aside>

            <section class="login-card">
                <div class="login-header">
                    <p class="eyebrow accent">Bem-vindo</p>
                    <h2>Entrar no sistema</h2>
                </div>

                <?php if (!empty($errors)): ?>
                    <div class="alert alert-danger">
                        <?php foreach ($errors as $error): ?>
                            <p><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <form method="POST" action="<?php echo url('login'); ?>" class="login-form">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="seu@email.com" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Senha</label>
                        <input type="password" id="password" name="password" placeholder="Digite sua senha" required>
                    </div>

                    <div class="form-row">
                        <label class="remember-me">
                            <input type="checkbox" name="remember">
                            <span>Lembrar-me</span>
                        </label>
                        <a href="#">Esqueceu a senha?</a>
                    </div>

                    <button type="submit" class="btn btn-primary btn-large">Entrar</button>
                </form>

                <div class="login-footer">
                    <span class="small-text">Acesso por perfil:</span>
                    <div class="profile-marks">
                        <span>Administrador</span>
                        <span>Caixa</span>
                        <span>Estoquista</span>
                    </div>
                </div>
            </section>
        </div>
    </div>
</body>
</html>
