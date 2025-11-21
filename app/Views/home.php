<div class="row colored-section container-fluid">
  <div class="col-lg-6 heading">
    <h1 class="big-heading">Adote um <span>gatinho</span> hoje</h1>
    <p>Encontre o companheiro perfeito! Nossos gatinhos estão esperando por um lar cheio de amor e carinho</p>

    <button type="button" class="btn btn-outline-dark">
      <span class="fa-solid fa-paw me-2"></span> Vários gatos aguardando
    </button>

    <button type="button" class="btn btn-outline-danger">100% de amor garantido</button>
  </div>

  <div class="image-title-div col-lg-6">
    <img class="title-image" src="<?= base_url('imgs/kittens-9281354_1280.png') ?>" alt="cesta de gatinhos">
  </div>
</div>

<section class="white-section" id="features">
  <h2 class="section-heading">Gatinhos disponíveis para adoção!</h2>
  <p>Conheça nossos amiguinhos especiais. Cada um tem sua personalidade única!</p>

  <div class="row">

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

        <div class="pricing-cards col-lg-4 col-md-6 mb-4">
          <div class="card h-100 shadow-sm">
            <div class="card-header p-0 overflow-hidden" style="height: 250px;">

              <img src="<?= $imagemUrl ?>"
                alt="Foto de <?= esc($gato['nome']) ?>"
                class="card-img-top"
                style="width: 100%; height: 100%; object-fit: cover;"
                onerror="this.onerror=null;this.src='<?= $imgGenerica ?>';">
            </div>
            <div class="card-body d-grid gap-2">
              <h2 class="card-title"><?= esc($gato['nome']) ?></h2>
              <h6 class="text-muted"><?= esc($gato['idade']) ?></h6>
              <p class="card-text text-truncate-3"><?= esc($gato['descricao']) ?></p>

              <button class="btn btn-lg btn-block btn-outline-info mt-auto" type="button">
                <i class="fa-regular fa-heart me-2"></i>Quero adotar
              </button>
            </div>
          </div>
        </div>

      <?php endforeach; ?>

    <?php else : ?>
      <div class="col-12 text-center py-5">
        <h3 class="text-muted">Nenhum gatinho cadastrado no momento. 😿</h3>
        <p>Volte em breve ou cadastre um se você for uma ONG/Protetor!</p>
      </div>
    <?php endif; ?>

  </div>

  <div class="d-flex justify-content-center mt-4">
    <?= $pager->links('default', 'bs_full') ?>
  </div>

</section>