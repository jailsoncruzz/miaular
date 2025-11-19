<?php include 'commons/header.php'; ?>
<?php include 'commons/navbar.php'; ?>

<div class="row colored-section container-fluid">
  <div class="col-lg-6 heading">
    <h1 class="big-heading">Adote um <span>gatinho</span> hoje</h1>
    <p>Encontre o companheiro perfeito! Nossos gatinhos estão esperando por um lar cheio de amor e carinho</p>
    <button type="button" class="btn btn-outline-dark"></span>15+ gatos aguardando adoção</button>
    <button type="button" class="btn btn-outline-danger">100% de amor garantido para a vida</button>
  </div>

  <div class="image-title-div col-lg-6">
    <img class="title-image" src="imgs/kittens-9281354_1280.png" alt="cesta de gatinhos">
  </div>
</div>
</section>

<!--Features-->
<section class="white-section" id="features">
  <h2 class="section-heading">Gatinhos disponíveis para adoção!</h2>
  <p>Conheça nossos amiguinhos especiais que estão esperando por uma família amorosa. Cada um tem sua personalidade única!</p>

  <div class="row">
    <div class="pricing-cards col-lg-4 col-md-6">
      <div class="card">
        <div class="card-header">
          <img src="imgs/foto1.jpeg">
        </div>
        <div class="card-body d-grid gap-2">
          <h2>Melinha</h2>
          <p>1 ano</p>
          <p>Gatinha cariosa que adora brincar em caixas e dormir em máquinas de lavar</p>
          <button class="btn btn-lg btn-block btn-outline-info" type="button">Quero adotar</button>
        </div>
      </div>
    </div>
    <div class="pricing-cards col-lg-4 col-md-6">
      <div class="card">
        <div class="card-header">
          <img src="imgs/foto2.jpg">
        </div>
        <div class="card-body d-grid gap-2">
          <h2>José</h2>
          <p>1 ano e 6 meses</p>
          <p>Gatinho manhoso que ama carinho e correr pela casa</p>
          <button class="btn btn-lg btn-block btn-outline-info" type="button">Quero adotar</button>
        </div>
      </div>
    </div>
    <div class="pricing-cards col-lg-4 col-md">
      <div class="card">
        <div class="card-header">
          <img src="imgs/foto3.jpg">
        </div>
        <div class="card-body d-grid gap-2">
          <h2>Atena</h2>
          <p>2 anos</p>
          <p>Gatinha acanhada que ama se esconder e dar sustos!</p>
          <button class="btn btn-lg btn-block btn-outline-info" type="button">Quero adotar</button>
        </div>
      </div>
    </div>
  </div>

</section>

<!--Modal-->
<section class="" id="addCat">
  <div class="modal fade" id="catModal" tabindex="-1" aria-labelledby="catModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title" id="catModalLabel"><span class="fa-solid fa-cat me-2"></span> Detalhes</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
        </div>
        <!-- Formulário de Adição de Gato -->
        <div class="modal-body">
          <form id="addCatForm" class="row g-3">
            <div class="col-12">
              <label for="catName" class="form-label small fw-semibold">Nome do Gato</label>
              <input type="text" id="catName" name="name" required placeholder="Ex: José" class="form-control">
            </div>
            <div class="col-12">
              <label for="catAge" class="form-label small fw-semibold">Idade (em meses/anos)</label>
              <input type="text" id="catAge" name="age" required placeholder="Ex: 1 ano e 6 meses" class="form-control">
            </div>
            <div class="col-12">
              <label for="catDescription" class="form-label small fw-semibold">Descrição/Personalidade</label>
              <textarea id="catDescription" name="description" rows="3" required placeholder="Gatinho(a) carinhoso(a), brincalhão(a)..." class="form-control"></textarea>
            </div>
            <div class="col-12">
              <label for="catPhoto" class="form-label small fw-semibold">URL da Foto</label>
              <input type="url" id="catPhoto" name="photoUrl" placeholder="https://exemplo.com/foto-gato.jpg" class="form-control">
              <div class="form-text">
                Link para a foto do gatinho.
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-primary">
            <span class="fa-solid fa-paper-plane me-1"></span>Adicionar</button>
        </div>
      </div>
    </div>
  </div>
</section>
<?php include 'commons/footer.php'; ?>