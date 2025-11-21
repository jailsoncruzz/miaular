<div class="modal fade" id="modalSolicitacao" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-info text-white">
        <h5 class="modal-title"><i class="fa-solid fa-heart me-2"></i>Solicitar Adoção</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      
      <form action="<?= base_url('solicitacoes/criar') ?>" method="post">
          <?= csrf_field() ?>
          <input type="hidden" name="gato_id" id="solicitaGatoId">
          <input type="hidden" name="protetor_id" id="solicitaProtetorId">

          <div class="modal-body">
              <p class="lead">Você está demonstrando interesse em: <strong id="solicitaNomeGato"></strong></p>
              
              <div class="mb-3">
                  <label class="form-label fw-semibold">Escreva uma mensagem para o protetor:</label>
                  <textarea name="mensagem" class="form-control" rows="4" required 
                  placeholder="Olá, gostei muito desse gatinho! Tenho tela nas janelas e..."></textarea>
              </div>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
              <button type="submit" class="btn btn-info text-white">Enviar Solicitação</button>
          </div>
      </form>
    </div>
  </div>
</div>

<script>
    // Script para passar dados do botão para o modal
    const botoesAdotar = document.querySelectorAll('.btn-adotar');
    botoesAdotar.forEach(btn => {
        btn.addEventListener('click', function() {
            document.getElementById('solicitaGatoId').value = this.getAttribute('data-id');
            document.getElementById('solicitaProtetorId').value = this.getAttribute('data-protetor');
            document.getElementById('solicitaNomeGato').innerText = this.getAttribute('data-nome');
        });
    });
</script>