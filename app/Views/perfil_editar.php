<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">

            <div class="d-flex align-items-center mb-4">
                <h1 class="h3 mb-0 text-primary fw-bold">
                    <i class="fa-solid fa-user-pen me-2"></i>Meu Perfil
                </h1>
            </div>

            <?php if (session()->getFlashdata('msg-success')): ?>
                <div class="alert alert-success alert-dismissible fade show">
                    <i class="fa-solid fa-check-circle me-2"></i>
                    <?= session()->getFlashdata('msg-success') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('errors')): ?>
                <div class="alert alert-danger">
                    <ul class="mb-0 ps-3">
                        <?php foreach (session()->getFlashdata('errors') as $error): ?>
                            <li><?= esc($error) ?></li>
                        <?php endforeach ?>
                    </ul>
                </div>
            <?php endif; ?>

            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body p-4">

                    <form action="<?= base_url('perfil/salvar') ?>" method="post">
                        <?= csrf_field() ?>

                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold text-uppercase">Tipo de Conta</label>
                            <input type="text" class="form-control bg-light" value="<?= ucfirst($usuario['perfil']) ?>" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="nome" class="form-label fw-semibold">Nome Completo / ONG</label>
                            <input type="text" name="nome" id="nome" class="form-control"
                                value="<?= old('nome', $usuario['nome']) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">Email</label>
                            <input type="email" name="email" id="email" class="form-control"
                                value="<?= old('email', $usuario['email']) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="telefone" class="form-label fw-semibold">Telefone</label>
                            <input type="text" name="telefone" id="telefone" class="form-control"
                                value="<?= old('telefone', $usuario['telefone']) ?>" required>
                        </div>

                        <hr class="my-4">

                        <div class="mb-4">
                            <label for="senha" class="form-label fw-semibold text-danger">
                                <i class="fa-solid fa-lock me-1"></i>Alterar Senha
                            </label>
                            <input type="password" name="senha" id="senha" class="form-control"
                                placeholder="Deixe em branco para manter a senha atual">
                            <div class="form-text">Só preencha se quiser mudar sua senha de acesso.</div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="<?= base_url('/') ?>" class="btn btn-outline-secondary px-4">Cancelar</a>
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="fa-solid fa-save me-2"></i>Salvar Alterações
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>