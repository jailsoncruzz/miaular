<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="bg-primary text-white text-center py-3 rounded-top-4">
                    <h2 class="h4 mb-0">
                        <span class="fa-solid fa-right-to-bracket me-2"></span>Acesse sua conta
                    </h2>
                </div>
                <div class="card-body p-4">

                    <?php if (session()->getFlashdata('msg')): ?>
                        <div class="alert alert-danger text-center">
                            <?= session()->getFlashdata('msg') ?>
                        </div>
                    <?php endif; ?>

                    <form action="<?= base_url('login/autenticar') ?>" method="post">

                        <?= csrf_field() ?>

                        <div class="mb-3">
                            <label for="emailInput" class="form-label fw-semibold">Email</label>
                            <input type="email" name="email" class="form-control" id="emailInput" placeholder="seu.email@exemplo.com" required>
                        </div>

                        <div class="mb-4">
                            <label for="passwordInput" class="form-label fw-semibold">Senha</label>
                            <input type="password" name="senha" class="form-control" id="passwordInput" placeholder="Senha" required>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">Entrar</button>
                            <a href="#" class="btn btn-link text-muted">Esqueceu sua senha?</a>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center small text-muted">
                    Novo por aqui? <a href="<?= base_url('cadastro') ?>" class="text-primary fw-semibold">Crie uma conta</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if (session()->getFlashdata('msg-success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fa-solid fa-check-circle me-2"></i>
        <?= session()->getFlashdata('msg-success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('msg')): ?>
<?php endif; ?>