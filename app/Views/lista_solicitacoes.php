<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-primary fw-bold">
            <i class="fa-regular fa-envelope-open me-2"></i>Solicitações de Adoção
        </h2>
    </div>

    <?php if (empty($solicitacoes)): ?>
        <div class="text-center py-5 text-muted bg-light rounded-3">
            <i class="fa-regular fa-folder-open fa-3x mb-3"></i>
            <h4>Nenhuma solicitação encontrada.</h4>
            <p>Quando alguém se interessar por um gatinho, aparecerá aqui!</p>
        </div>
    <?php else: ?>

        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-4">Gato</th>
                                <th>Interessado / Contato</th>
                                <th>Status</th>
                                <th>Última Interação</th>
                                <th class="text-end pe-4">Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($solicitacoes as $solic): ?>
                                <?php
                                // Define classe da linha baseada no status
                                $bgClass = ($solic['status'] == 'pendente') ? 'bg-white' : 'bg-light text-muted';

                                // Resolve foto
                                $foto = (!empty($solic['foto_gato']) && strpos($solic['foto_gato'], 'http') === 0)
                                    ? $solic['foto_gato']
                                    : base_url($solic['foto_gato'] ?: 'imgs/sem-foto.jpg');
                                ?>
                                <tr class="<?= $bgClass ?>">
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center">
                                            <img src="<?= $foto ?>" class="rounded-circle me-3 shadow-sm"
                                                style="width: 45px; height: 45px; object-fit: cover;">
                                            <div class="fw-bold"><?= esc($solic['nome_gato']) ?></div>
                                        </div>
                                    </td>
                                    <td>
                                        <i class="fa-regular fa-user me-1 text-secondary"></i>
                                        <?= esc($solic['nome_interessado']) ?>
                                        <span class="badge bg-secondary rounded-pill" style="font-size: 0.6em;">
                                            <?= ucfirst($solic['perfil_interessado']) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <?php if ($solic['status'] == 'pendente'): ?>
                                            <span class="badge bg-warning text-dark">
                                                <i class="fa-regular fa-clock me-1"></i>Pendente
                                            </span>
                                        <?php elseif ($solic['status'] == 'concluida'): ?>
                                            <span class="badge bg-success">
                                                <i class="fa-solid fa-check me-1"></i>Concluída
                                            </span>
                                        <?php else: ?>
                                            <span class="badge bg-danger">Recusada</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="small">
                                        <?= date('d/m/Y H:i', strtotime($solic['updated_at'])) ?>
                                    </td>
                                    <td class="text-end pe-4">
                                        <a href="<?= base_url('solicitacoes/chat/' . $solic['id']) ?>"
                                            class="btn btn-sm btn-primary">
                                            Ver Chat <i class="fa-solid fa-arrow-right ms-1"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>