<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="bg-primary text-white text-center py-3 rounded-top-4">
                    <h2 class="h4 mb-0">
                        <span class="fa-solid fa-user-plus me-2"></span>Crie sua conta
                    </h2>
                    <p class="small mb-0 mt-1">Junte-se a nós.</p>
                </div>
                <div class="card-body p-4">
                    
                    <?php if(session()->getFlashdata('errors')): ?>
                        <div class="alert alert-danger">
                            <ul class="mb-0 ps-3">
                            <?php foreach(session()->getFlashdata('errors') as $error): ?>
                                <li><?= esc($error) ?></li>
                            <?php endforeach ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <form action="<?= base_url('cadastro/salvar') ?>" method="post">
                        
                        <?= csrf_field() ?>

                        <div class="mb-3">
                            <label for="userType" class="form-label fw-semibold">Você é:</label>
                            <select class="form-select" name="perfil" id="userType" required>
                                <option value="" disabled selected>Selecione seu tipo de conta</option>
                                <option value="adotante">Adotante (Buscando um gatinho)</option>
                                <option value="protetor">Protetor Independente (Pessoa física)</option>
                                <option value="ong">ONG / Abrigo (Pessoa jurídica)</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="fullName" class="form-label fw-semibold">Nome Completo / Nome da ONG</label>
                            <input type="text" name="nome" class="form-control" id="fullName" placeholder="Seu nome" required value="<?= old('nome') ?>">
                        </div>

                        <div class="mb-3">
                            <label for="emailInput" class="form-label fw-semibold">Email</label>
                            <input type="email" name="email" class="form-control" id="emailInput" placeholder="seu.email@exemplo.com" required value="<?= old('email') ?>">
                        </div>

                        <div class="mb-3">
                            <label for="phoneInput" class="form-label fw-semibold">Telefone</label>
                            <input type="tel" name="telefone" class="form-control" id="phoneInput" placeholder="(XX) XXXXX-XXXX" required value="<?= old('telefone') ?>">
                        </div>

                        <div class="mb-4">
                            <label for="passwordInput" class="form-label fw-semibold">Senha</label>
                            <input type="password" name="senha" class="form-control" id="passwordInput" placeholder="Mínimo 6 caracteres" required>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <span class="fa-solid fa-paper-plane me-2"></span>Cadastrar</button>
                        </div>
                    </form>
                    </div>
                <div class="card-footer text-center small text-muted">
                    Já tem conta? <a href="<?= base_url('login') ?>" class="text-primary fw-semibold">Faça Login</a>
                </div>
            </div>
        </div>
    </div>
</div>