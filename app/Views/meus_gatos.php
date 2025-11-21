<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-primary fw-bold"><i class="fa-solid fa-list-check me-2"></i>Gerenciar Meus Gatos</h2>

        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#catModal">
            <i class="fa-solid fa-plus me-2"></i>Novo Gato
        </button>
    </div>

    <?php if (session()->getFlashdata('msg-success')): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <?= session()->getFlashdata('msg-success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4">Gato</th>
                            <th>Status</th>
                            <th>Idade</th>
                            <th class="text-end pe-4">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($gatos) && is_array($gatos)): ?>
                            <?php foreach ($gatos as $gato): ?>
                                <?php
                                // Resolve a imagem
                                $imgUrl = (!empty($gato['foto']) && strpos($gato['foto'], 'http') === 0)
                                    ? $gato['foto']
                                    : base_url($gato['foto'] ?: 'imgs/sem-foto.jpg');
                                ?>
                                <tr>
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center">
                                            <img src="<?= $imgUrl ?>" class="rounded-circle me-3"
                                                style="width: 50px; height: 50px; object-fit: cover;">
                                            <div>
                                                <div class="fw-bold"><?= esc($gato['nome']) ?></div>
                                                <div class="small text-muted text-truncate" style="max-width: 150px;">
                                                    <?= esc($gato['descricao']) ?>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <?php if ($gato['adotado']): ?>
                                            <span class="badge bg-success rounded-pill">
                                                <i class="fa-solid fa-house-user me-1"></i>Adotado
                                            </span>
                                        <?php else: ?>
                                            <span class="badge bg-info text-dark rounded-pill">
                                                <i class="fa-solid fa-paw me-1"></i>Disponível
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= esc($gato['idade']) ?></td>
                                    <td class="text-end pe-4">

                                        <?php if ($gato['adotado']): ?>
                                            <a href="<?= base_url('gatos/status/' . $gato['id']) ?>"
                                                class="btn btn-sm btn-outline-secondary me-1" title="Marcar como Disponível">
                                                <i class="fa-solid fa-rotate-left"></i>
                                            </a>
                                        <?php else: ?>
                                            <a href="<?= base_url('gatos/status/' . $gato['id']) ?>"
                                                class="btn btn-sm btn-outline-success me-1" title="Marcar como Adotado">
                                                <i class="fa-solid fa-check"></i>
                                            </a>
                                        <?php endif; ?>

                                        <button type="button"
                                            class="btn btn-sm btn-outline-warning me-1 btn-editar"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editCatModal"

                                            data-id="<?= $gato['id'] ?>"
                                            data-nome="<?= esc($gato['nome']) ?>"
                                            data-idade="<?= esc($gato['idade']) ?>"
                                            data-descricao="<?= esc($gato['descricao']) ?>"
                                            data-foto="<?= esc($gato['foto']) ?>"
                                            title="Editar">
                                            <i class="fa-solid fa-pen"></i>
                                        </button>

                                        <a href="<?= base_url('gatos/excluir/' . $gato['id']) ?>"
                                            class="btn btn-sm btn-outline-danger"
                                            onclick="return confirm('Tem certeza que deseja excluir <?= esc($gato['nome']) ?>?');">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="text-center py-5 text-muted">
                                    Você ainda não cadastrou nenhum gatinho.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-center mt-4">
        <?= $pager->links('default', 'bs_full') ?>
    </div>
</div>

<?= view('commons/modal_editar') ?>

<script>
    const botoesEditar = document.querySelectorAll('.btn-editar');

    botoesEditar.forEach(botao => {
        botao.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const nome = this.getAttribute('data-nome');
            const idade = this.getAttribute('data-idade');
            const descricao = this.getAttribute('data-descricao');
            const foto = this.getAttribute('data-foto');

            document.getElementById('editId').value = id;
            document.getElementById('editNome').value = nome;
            document.getElementById('editIdade').value = idade;
            document.getElementById('editDescricao').value = descricao;

            if (foto && foto.startsWith('http')) {
                document.getElementById('editUrlFoto').value = foto;
            } else {
                document.getElementById('editUrlFoto').value = '';
            }
        });
    });
</script>
</div>