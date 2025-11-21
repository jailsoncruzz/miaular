<!--Principal-->
<div class="container py-5">
    <h1 class="text-center mb-3 text-primary fw-bold">
        <span class="fa-solid fa-paw me-2"></span>Encontre o seu gatinho
    </h1>
    <p class="text-center text-muted mb-5">Role para baixo para conhecer todos os nossos gatinhos à espera de um lar.</p>

    <div id="catAdoptionGrid" class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-4 g-4">

        <?php if (!empty($gatos) && is_array($gatos)) : ?>

            <?php foreach ($gatos as $gato) : ?>

                <?php
                $imgGenerica = base_url('imgs/sem-foto.jpg');
                $imagemUrl = $imgGenerica;

                if (!empty($gato['foto'])) {
                    if (strpos($gato['foto'], 'http') === 0) {
                        $imagemUrl = $gato['foto'];
                    } else {
                        $imagemUrl = base_url($gato['foto']);
                    }
                }
                ?>

                <div class="col pricing-cards">
                    <div class="card cat-card h-100 shadow-sm border-0">

                        <div class="card-header p-0 overflow-hidden" style="height: 12rem;">
                            <img src="<?= $imagemUrl ?>"
                                alt="<?= esc($gato['nome']) ?>"
                                style="width: 100%; height: 100%; object-fit: cover;"
                                onerror="this.onerror=null;this.src='<?= $imgGenerica ?>';">
                        </div>

                        <div class="card-body d-grid gap-2">
                            <h2 class="fs-4 fw-bold mb-0"><?= esc($gato['nome']) ?></h2>
                            <h6 class="text-muted mb-1"><?= esc($gato['idade']) ?></h6>

                            <p class="small text-secondary text-truncate" title="<?= esc($gato['descricao']) ?>">
                                <?= esc($gato['descricao']) ?>
                            </p>

                            <?php if (session()->get('isLoggedIn')): ?>

                                <?php
                                $isGestor = in_array(session()->get('perfil'), ['ong', 'protetor']);

                                $jaSolicitou = in_array($gato['id'], $idsSolicitados ?? []);
                                ?>

                                <?php if ($isGestor): ?>
                                    <button class="btn btn-lg btn-block btn-light text-muted mt-auto border" disabled>
                                        <i class="fa-solid fa-shield-cat me-2"></i>
                                    </button>

                                <?php elseif ($jaSolicitou): ?>
                                    <a href="<?= base_url('solicitacoes') ?>" class="btn btn-lg btn-block btn-warning mt-auto text-dark">
                                        <i class="fa-solid fa-comments me-2"></i>Ver Chat
                                    </a>

                                <?php else: ?>
                                    <button type="button" class="btn btn-lg btn-block btn-outline-info mt-auto btn-adotar"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalSolicitacao"
                                        data-id="<?= $gato['id'] ?>"
                                        data-nome="<?= esc($gato['nome']) ?>"
                                        data-protetor="<?= $gato['usuario_id'] ?>">
                                        <i class="fa-regular fa-heart me-2"></i>Quero adotar
                                    </button>
                                <?php endif; ?>

                            <?php else: ?>
                                <a href="<?= base_url('login') ?>" class="btn btn-lg btn-block btn-outline-info mt-auto">
                                    <i class="fa-regular fa-heart me-2"></i>Login para adotar
                                </a>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        <?php else : ?>
            <div class="col-12 text-center">
                <div class="alert alert-warning">
                    Nenhum gatinho cadastrado no momento. Volte em breve!
                </div>
            </div>
        <?php endif; ?>

    </div>

    <div class="d-flex justify-content-center mt-5">
        <?= $pager->links('default', 'bs_full') ?>
    </div>

</div>
<?= view('commons/modal_solicitacao') ?>