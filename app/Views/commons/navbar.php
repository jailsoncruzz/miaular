<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
    <div class="container-fluid white-section">
        <a class="navbar-brand" href="<?= base_url('/') ?>">MiauLar</a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <div class="d-flex align-items-center gap-2">
                
                <a href="<?= base_url('gatos/adocao') ?>" class="btn btn-dark">
                    <span class="fa-regular fa-heart me-1"></span> Adoção
                </a>

                <?php 
                    $isGestor = session()->get('isLoggedIn') && in_array(session()->get('perfil'), ['ong', 'protetor']);
                    $isGuest = !session()->get('isLoggedIn');
                ?>

                <?php if($isGestor): ?>
                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#catModal">
                        <span class="fa-solid fa-plus me-1"></span> Adicionar
                    </button>

                <?php elseif($isGuest): ?>
                    <a href="<?= base_url('login') ?>" class="btn btn-outline-primary">
                        <span class="fa-solid fa-plus me-1"></span> Adicionar
                    </a>
                <?php endif; ?>
                <?php if(session()->get('isLoggedIn')): ?>
                    <span class="fw-bold mx-2">Olá, <?= strtok(session()->get('nome'), " ") ?>!</span>
                    <a href="<?= base_url('logout') ?>" class="btn btn-danger">
                        Sair <span class="fa-solid fa-right-from-bracket ms-1"></span>
                    </a>
                <?php else: ?>
                    <a href="<?= base_url('login') ?>" class="btn btn-outline-primary">
                        Login
                    </a>
                <?php endif; ?>

            </div>
        </div>
    </div>
</nav>