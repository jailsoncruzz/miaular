<div class="modal fade" id="catModal" tabindex="-1" aria-labelledby="catModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
            <h5 class="modal-title" id="catModalLabel"><span class="fa-solid fa-cat me-2"></span> Detalhes do Gato</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
        </div>
        
        <form action="<?= base_url('gatos/salvar') ?>" method="post" enctype="multipart/form-data" id="addCatForm">
            
            <?= csrf_field() ?>
            
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label small fw-semibold">Nome do Gato</label>
                        <input type="text" name="nome" required class="form-control" placeholder="Ex: Frajola">
                    </div>
                    
                    <div class="col-12">
                        <label class="form-label small fw-semibold">Idade</label>
                        <input type="text" name="idade" required class="form-control" placeholder="Ex: 2 anos">
                    </div>
                    
                    <div class="col-12">
                        <label class="form-label small fw-semibold">Descrição</label>
                        <textarea name="descricao" rows="3" required class="form-control" placeholder="Descreva a personalidade dele..."></textarea>
                    </div>

                    <div class="col-12 bg-light p-3 rounded border">
                        <label class="form-label small fw-bold mb-2">Como você quer enviar a foto?</label>
                        
                        <div class="d-flex gap-3 mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="tipo_foto_radio" id="radioUpload" checked onclick="alternarFoto('upload')">
                                <label class="form-check-label" for="radioUpload">Enviar Arquivo</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="tipo_foto_radio" id="radioLink" onclick="alternarFoto('link')">
                                <label class="form-check-label" for="radioLink">Colocar Link</label>
                            </div>
                        </div>

                        <div id="containerUpload">
                            <input type="file" name="arquivo_foto" class="form-control" accept="image/*">
                            <div class="form-text small">Formatos: JPG, PNG. Máx: 2MB.</div>
                        </div>

                        <div id="containerLink" class="d-none">
                            <input type="url" name="url_foto" class="form-control" placeholder="Cole o link da imagem aqui (https://...)">
                        </div>
                    </div>
                    </div>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">
                    <span class="fa-solid fa-save me-1"></span> Salvar Gato
                </button>
            </div>
        </form>
      </div>
  </div>
</div>

<script>
    function alternarFoto(tipo) {
        // Pega os dois containers (caixas)
        const divUpload = document.getElementById('containerUpload');
        const divLink   = document.getElementById('containerLink');
        
        // Pega os inputs dentro deles para limpar se trocar
        const inputArquivo = divUpload.querySelector('input');
        const inputUrl     = divLink.querySelector('input');

        if (tipo === 'upload') {
            // Se escolheu UPLOAD:
            divUpload.classList.remove('d-none'); // Mostra Upload
            divLink.classList.add('d-none');      // Esconde Link
            inputUrl.value = '';                  // Limpa o link escrito
        } else {
            // Se escolheu LINK:
            divUpload.classList.add('d-none');    // Esconde Upload
            divLink.classList.remove('d-none');   // Mostra Link
            inputArquivo.value = '';              // Limpa o arquivo selecionado
        }
    }
</script>