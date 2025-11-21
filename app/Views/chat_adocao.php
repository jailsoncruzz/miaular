<div class="container py-5">
    <div class="row">

        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white text-center">
                    <h5 class="mb-0">Detalhes</h5>
                </div>
                <div class="card-body text-center">
                    <?php $foto = (!empty($solicitacao['foto_gato']) && strpos($solicitacao['foto_gato'], 'http') === 0) ? $solicitacao['foto_gato'] : base_url($solicitacao['foto_gato'] ?: 'imgs/sem-foto.jpg'); ?>
                    <img src="<?= $foto ?>" class="rounded-circle mb-3" style="width: 100px; height: 100px; object-fit: cover;">

                    <h4><?= esc($solicitacao['nome_gato']) ?></h4>

                    <div class="mt-3">
                        STATUS:
                        <?php if ($solicitacao['status'] == 'pendente'): ?>
                            <span class="badge bg-warning text-dark">Em Negociação</span>
                        <?php elseif ($solicitacao['status'] == 'concluida'): ?>
                            <span class="badge bg-success">Adoção Concluída</span>
                        <?php else: ?>
                            <span class="badge bg-danger">Recusada/Cancelada</span>
                        <?php endif; ?>
                    </div>

                    <?php if ($solicitacao['contato_liberado']): ?>
                        <div class="alert alert-success mt-3 text-start small">
                            <i class="fa-solid fa-unlock me-1"></i> <strong>Contato Liberado!</strong><br>
                            <?php if ($euSouProtetor): ?>
                                O adotante pode ver seu telefone/email.
                            <?php else: ?>
                                <strong>Protetor:</strong> <?= esc($solicitacao['nome_protetor']) ?><br>
                                <strong>Tel:</strong> <?= esc($solicitacao['tel_protetor']) ?><br>
                                <strong>Email:</strong> <?= esc($solicitacao['email_protetor']) ?>
                            <?php endif; ?>
                        </div>
                    <?php elseif (!$euSouProtetor): ?>
                        <div class="alert alert-secondary mt-3 small">
                            <i class="fa-solid fa-lock me-1"></i> Contato do protetor ainda não liberado.
                        </div>
                    <?php endif; ?>

                    <hr>

                    <?php if ($euSouProtetor && $solicitacao['status'] == 'pendente'): ?>
                        <div class="d-grid gap-2">
                            <?php if (!$solicitacao['contato_liberado']): ?>
                                <form action="<?= base_url('solicitacoes/gerenciar') ?>" method="post">
                                    <input type="hidden" name="solicitacao_id" value="<?= $solicitacao['id'] ?>">
                                    <input type="hidden" name="acao" value="liberar_contato">
                                    <button class="btn btn-outline-primary w-100 btn-sm">
                                        <i class="fa-solid fa-address-card me-1"></i> Liberar meu Contato
                                    </button>
                                </form>
                            <?php endif; ?>

                            <form action="<?= base_url('solicitacoes/gerenciar') ?>" method="post">
                                <input type="hidden" name="solicitacao_id" value="<?= $solicitacao['id'] ?>">
                                <input type="hidden" name="acao" value="concluir">
                                <button class="btn btn-success w-100" onclick="return confirm('Confirmar adoção? Isso marcará o gato como adotado.')">
                                    <i class="fa-solid fa-check me-1"></i> Concluir Adoção
                                </button>
                            </form>

                            <form action="<?= base_url('solicitacoes/gerenciar') ?>" method="post">
                                <input type="hidden" name="solicitacao_id" value="<?= $solicitacao['id'] ?>">
                                <input type="hidden" name="acao" value="recusar">
                                <button class="btn btn-danger w-100 btn-sm" onclick="return confirm('Recusar adoção? Isso fechará o ticket.')">
                                    <i class="fa-solid fa-xmark me-1"></i> Recusar Adoção
                                </button>
                            </form>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body d-flex flex-column" style="height: 500px;">

                    <div class="flex-grow-1 overflow-auto mb-3 pe-2" style="background: #f8f9fa; border-radius: 10px; padding: 15px;">
                        <?php foreach ($mensagens as $msg): ?>
                            <?php $ehMeu = ($msg['remetente_id'] == session()->get('id')); ?>

                            <div class="d-flex mb-3 <?= $ehMeu ? 'justify-content-end' : 'justify-content-start' ?>">
                                <div class="card <?= $ehMeu ? 'bg-primary text-white' : 'bg-white border' ?>" style="max-width: 75%;">
                                    <div class="card-body py-2 px-3">
                                        <p class="mb-1"><?= esc($msg['mensagem']) ?></p>
                                        <small class="<?= $ehMeu ? 'text-light' : 'text-muted' ?>" style="font-size: 0.7em;">
                                            <?= date('d/m H:i', strtotime($msg['created_at'])) ?>
                                        </small>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <?php if ($solicitacao['status'] == 'pendente'): ?>
                        <form action="<?= base_url('solicitacoes/responder') ?>" method="post" class="d-flex gap-2">
                            <input type="hidden" name="solicitacao_id" value="<?= $solicitacao['id'] ?>">
                            <input type="text" name="mensagem" class="form-control" placeholder="Digite sua mensagem..." required autocomplete="off">
                            <button class="btn btn-primary">
                                <i class="fa-solid fa-paper-plane"></i>
                            </button>
                        </form>
                    <?php else: ?>
                        <div class="alert alert-secondary text-center m-0">
                            Esta solicitação foi finalizada. Não é possível enviar novas mensagens.
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>

    </div>
</div>