<?php
$session = session();
$isLoggedIn = $session->get('isLoggedIn');
$perfil = $session->get('perfil');
$userId = $session->get('id');

$isGestor = $isLoggedIn && in_array($perfil, ['ong', 'protetor']);
$isGuest = !$isLoggedIn;
$totalNotificacoes = 0;

if ($isLoggedIn) {
    $solicModel = new \App\Models\SolicitacaoModel();

    if ($isGestor) {
        $totalNotificacoes = $solicModel->where('protetor_id', $userId)
            ->where('status', 'pendente')
            ->countAllResults();
    } else {
        $totalNotificacoes = $solicModel->groupStart()
            ->where('contato_liberado', 1)
            ->orWhere('status', 'concluida')
            ->groupEnd()
            ->where('adotante_id', $userId)
            ->countAllResults();
    }
}
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= base_url('/') ?>">MiauLar</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <div class="d-flex align-items-center gap-2">

                
                <?php if ($isGestor): ?>
                    <a href="<?= base_url('gatos/meus-gatos') ?>" class="btn btn-link text-decoration-none text-dark fw-bold">
                        <i class="fa-solid fa-list-check me-1"></i> Gerenciar
                    </a>

                <?php else: ?>
                    <a href="<?= base_url('gatos/adocao') ?>" class="btn btn-dark">
                        <span class="fa-regular fa-heart me-1"></span> Adoção
                    </a>

                <?php endif; ?>

                <?php if ($isGestor): ?>
                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#catModal">
                        <span class="fa-solid fa-plus me-1"></span> Adicionar
                    </button>
                <?php elseif ($isGuest): ?>
                    <a href="<?= base_url('login') ?>" class="btn btn-outline-primary">
                        <span class="fa-solid fa-plus me-1"></span> Adicionar
                    </a>
                <?php endif; ?>


                <?php if ($isLoggedIn): ?>

                    <div class="d-flex align-items-center ms-3">
                        <span class="fw-bold me-3 text-dark">Olá, <?= strtok($session->get('nome'), " ") ?>!</span>
                        <div class="vr me-3"></div>

                        <a href="<?= base_url('solicitacoes') ?>" class="position-relative text-dark me-3" title="Notificações">
                            <i class="fa-regular fa-bell fa-lg"></i>
                            <?php if ($totalNotificacoes > 0): ?>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.6rem;">
                                    <?= $totalNotificacoes > 99 ? '99+' : $totalNotificacoes ?>
                                    <span class="visually-hidden">novas notificações</span>
                                </span>
                            <?php endif; ?>
                        </a>

                        <a href="<?= base_url('perfil/editar') ?>" class="btn btn-sm btn-light text-primary me-2" title="Editar Perfil">
                            <i class="fa-solid fa-user-gear"></i>
                        </a>

                        <a href="<?= base_url('logout') ?>" class="btn btn-danger btn-sm">
                            Sair <span class="fa-solid fa-right-from-bracket ms-1"></span>
                        </a>
                    </div>

                <?php else: ?>
                    <a href="<?= base_url('login') ?>" class="btn btn-outline-primary ms-2">
                        Login
                    </a>
                <?php endif; ?>

            </div>
        </div>
    </div>
</nav>