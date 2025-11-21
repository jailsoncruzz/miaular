<div class="modal fade" id="editCatModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-warning text-dark">
                <h5 class="modal-title"><span class="fa-solid fa-pen-to-square me-2"></span> Editar Gato</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>

            <form action="<?= base_url('gatos/editar') ?>" method="post" enctype="multipart/form-data">

                <?= csrf_field() ?>

                <input type="hidden" name="id" id="editId">

                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label small fw-semibold">Nome do Gato</label>
                            <input type="text" name="nome" id="editNome" required class="form-control">
                        </div>
                        <div class="col-12">
                            <label class="form-label small fw-semibold">Idade</label>
                            <input type="text" name="idade" id="editIdade" required class="form-control">
                        </div>
                        <div class="col-12">
                            <label class="form-label small fw-semibold">Descrição</label>
                            <textarea name="descricao" id="editDescricao" rows="3" required class="form-control"></textarea>
                        </div>

                        <div class="col-12 bg-light p-3 rounded border">
                            <label class="form-label small fw-bold">Atualizar Foto (Opcional)</label>

                            <div class="d-flex gap-3 mb-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="tipo_foto_radio" value="upload" checked onclick="alternarFotoEdit('upload')">
                                    <label class="form-check-label">Upload</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="tipo_foto_radio" value="link" onclick="alternarFotoEdit('link')">
                                    <label class="form-check-label">Link</label>
                                </div>
                            </div>

                            <div id="boxEditUpload">
                                <input type="file" name="arquivo_foto" class="form-control" accept="image/*">
                            </div>
                            <div id="boxEditLink" class="d-none">
                                <input type="url" name="url_foto" id="editUrlFoto" class="form-control" placeholder="https://...">
                            </div>
                            <div class="form-text small mt-1">Se não alterar, mantém a foto atual.</div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-warning">
                        <span class="fa-solid fa-save me-1"></span> Salvar Alterações
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function alternarFotoEdit(tipo) {
        if (tipo === 'upload') {
            document.getElementById('boxEditUpload').classList.remove('d-none');
            document.getElementById('boxEditLink').classList.add('d-none');
        } else {
            document.getElementById('boxEditUpload').classList.add('d-none');
            document.getElementById('boxEditLink').classList.remove('d-none');
        }
    }
</script>