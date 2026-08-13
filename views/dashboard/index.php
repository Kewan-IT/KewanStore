<div class="dashboard-shell">
    <div class="container dashboard-container">
        <div class="dashboard-topbar">
            <div>
                <p class="eyebrow accent">Painel principal</p>
                <h1>Bem-vindo, <?php echo e($usuarioNome ?? 'Usuário'); ?></h1>
            </div>
            <div class="user-pill">
                <span class="status-dot"></span>
                <span><?php echo strtoupper(e($perfil ?? 'usuario')); ?></span>
            </div>
        </div>

        <div class="dashboard-grid">
            <div class="dashboard-card accent-green">
                <div class="card-head">
                    <span class="label">Vendas hoje</span>
                    <span class="trend up">+12%</span>
                </div>
                <div class="value"><?php echo $resumo['vendasHoje']; ?></div>
                <div class="meta">Comparando com o dia anterior</div>
            </div>

            <div class="dashboard-card accent-gold">
                <div class="card-head">
                    <span class="label">Caixa</span>
                    <span class="trend up">Hoje</span>
                </div>
                <div class="value"><?php echo formatarMoeda((float) $resumo['caixa']); ?></div>
                <div class="meta">Movimentação do dia</div>
            </div>

            <div class="dashboard-card accent-blue">
                <div class="card-head">
                    <span class="label">Produtos</span>
                    <span class="trend">Ativos</span>
                </div>
                <div class="value"><?php echo $resumo['produtos']; ?></div>
                <div class="meta">Itens em catálogo</div>
            </div>

            <div class="dashboard-card accent-purple">
                <div class="card-head">
                    <span class="label">Clientes</span>
                    <span class="trend">Base</span>
                </div>
                <div class="value"><?php echo $resumo['clientes']; ?></div>
                <div class="meta">Clientes cadastrados</div>
            </div>
        </div>

        <div class="dashboard-main">
            <section class="section-card wide-card">
                <div class="section-header">
                    <h3>Resumo operacional</h3>
                    <a href="#" class="text-link">Ver relatório completo</a>
                </div>

                <div class="chart-box">
                    <div class="chart-bars">
                        <div class="bar-group"><span class="bar bar-1" style="height: 42%"></span><small>Seg</small></div>
                        <div class="bar-group"><span class="bar bar-2" style="height: 54%"></span><small>Ter</small></div>
                        <div class="bar-group"><span class="bar bar-3" style="height: 63%"></span><small>Qua</small></div>
                        <div class="bar-group"><span class="bar bar-4" style="height: 72%"></span><small>Qui</small></div>
                        <div class="bar-group"><span class="bar bar-5" style="height: 69%"></span><small>Sex</small></div>
                        <div class="bar-group"><span class="bar bar-6" style="height: 88%"></span><small>Sáb</small></div>
                    </div>
                </div>
            </section>

            <aside class="section-card quick-actions">
                <div class="section-header">
                    <h3>Ações rápidas</h3>
                </div>

                <div class="action-list">
                    <a href="<?php echo url('produtos'); ?>" class="action-item">
                        <span class="icon">📦</span>
                        <div>
                            <strong>Produtos</strong>
                            <small>Gerenciar stock</small>
                        </div>
                    </a>
                    <a href="<?php echo url('vendas/pdv'); ?>" class="action-item">
                        <span class="icon">🧾</span>
                        <div>
                            <strong>PDV</strong>
                            <small>Nova venda</small>
                        </div>
                    </a>
                    <a href="<?php echo url('caixa'); ?>" class="action-item">
                        <span class="icon">💰</span>
                        <div>
                            <strong>Caixa</strong>
                            <small>Fechamento diário</small>
                        </div>
                    </a>
                    <a href="<?php echo url('relatorios'); ?>" class="action-item">
                        <span class="icon">📊</span>
                        <div>
                            <strong>Relatórios</strong>
                            <small>Visão geral</small>
                        </div>
                    </a>
                </div>
            </aside>
        </div>

        <div class="bottom-grid">
            <section class="section-card">
                <div class="section-header">
                    <h3>Alertas</h3>
                </div>
                <ul class="alert-list">
                    <li>
                        <span class="alert-indicator warning"></span>
                        <div>
                            <strong>Estoque baixo</strong>
                            <small>5 produtos precisam de reposição</small>
                        </div>
                    </li>
                    <li>
                        <span class="alert-indicator danger"></span>
                        <div>
                            <strong>Validade próxima</strong>
                            <small>3 itens expiram em menos de 7 dias</small>
                        </div>
                    </li>
                    <li>
                        <span class="alert-indicator success"></span>
                        <div>
                            <strong>Caixa em ordem</strong>
                            <small>Fechamento do dia sem pendências</small>
                        </div>
                    </li>
                </ul>
            </section>

            <section class="section-card">
                <div class="section-header">
                    <h3>Atividades recentes</h3>
                </div>
                <ul class="activity-list">
                    <li>
                        <span class="dot dot-green"></span>
                        <div>
                            <strong>Venda concluída</strong>
                            <small>Cliente: Maria M. · 10 min atrás</small>
                        </div>
                    </li>
                    <li>
                        <span class="dot dot-gold"></span>
                        <div>
                            <strong>Compra registrada</strong>
                            <small>Fornecedor: ABC Distribuição · 45 min atrás</small>
                        </div>
                    </li>
                    <li>
                        <span class="dot dot-blue"></span>
                        <div>
                            <strong>Produto revisado</strong>
                            <small>Arroz 5kg foi ajustado no estoque · 1h atrás</small>
                        </div>
                    </li>
                </ul>
            </section>
        </div>
    </div>
</div>
