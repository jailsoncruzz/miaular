<footer class="colored-section mt-auto py-3 bg-white border-top" id="footer">
    <div class="container-fluid text-center">
        <a class="social mx-2 text-muted" href="#"><span class="fa-brands fa-github-alt"></span></a>
        <a class="social mx-2 text-muted" href="#"><span class="social fa-brands fa-linkedin"></span></a>
        <p class="mt-2 text-muted small">© Copyright <?= date('Y') ?> MiauLar</p>
    </div>
</footer>

<?php 
    if(session()->get('isLoggedIn') && in_array(session()->get('perfil'), ['ong', 'protetor'])) {
        echo view('commons/modal_adicionar'); 
    }
?>

<?php
$msgErro = session()->getFlashdata('msg');
$msgSucesso = session()->getFlashdata('msg-success');

$toastMensagem = '';
$toastClasse = '';
$toastIcone = '';
$mostrarToast = false;

if ($msgSucesso) {
    $mostrarToast = true;
    $toastMensagem = $msgSucesso;
    $toastClasse = 'text-bg-success';
    $toastIcone = 'fa-check-circle';
} elseif ($msgErro) {
    $mostrarToast = true;
    $toastMensagem = $msgErro;
    $toastClasse = 'text-bg-danger';
    $toastIcone = 'fa-circle-exclamation';
}
?>

<?php if ($mostrarToast): ?>
    <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 2000;">
        <div id="liveToast" class="toast align-items-center <?= $toastClasse ?> border-0 shadow-lg" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body fs-6 fw-semibold">
                    <i class="fa-solid <?= $toastIcone ?> me-2"></i>
                    <?= $toastMensagem ?>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
<?php endif; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<?php if (isset($mostrarToast) && $mostrarToast): ?>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toastEl = document.getElementById('liveToast');
        const toast = new bootstrap.Toast(toastEl);
        toast.show();
    });
</script>
<?php endif; ?>

</body>
</html>