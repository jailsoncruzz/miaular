<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
    <div class="container-fluid white-section">
        <a class="navbar-brand" href="<?= base_url('/') ?>">MiauLar</a>
        
        <!-- Botão Hamburguer para Mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <div class="d-flex align-items-center gap-2">
                
                <!-- Botão Adoção -->
                <!-- Lógica: Aponta para a rota. Se não estiver logado, o Filter 'auth' no controller vai barrar e mandar pro login -->
                <a href="<?= base_url('gatos/adocao') ?>" class="btn btn-dark">
                    <span class="fa-regular fa-heart me-1"></span> Adoção
                </a>

                <!-- Botão Adicionar -->
                <!-- Lógica: Mostramos o botão. Se clicar e não estiver logado, o sistema redireciona. -->
                <?php 
                    // Definimos o link. Se for ONG/Protetor vai para adicionar. 
                    // Se não for logado, manda pro adicionar (e o sistema barra).
                    $linkAdicionar = base_url('gatos/adicionar');
                ?>
                
                <!-- Só mostra o botão Adicionar se:
                     1. Não estiver logado (para ser redirecionado ao login)
                     2. Estiver logado E for ONG ou Protetor 
                     (Esconde de quem é apenas Adotante para não gerar frustração) -->
                <?php if(!session()->get('isLoggedIn') || in_array(session()->get('perfil'), ['ong', 'protetor'])): ?>
                    <a href="<?= $linkAdicionar ?>" class="btn btn-outline-primary">
                        <span class="fa-solid fa-plus me-1"></span> Adicionar
                    </a>
                <?php endif; ?>

                <!-- Área do Usuário / Login -->
                <?php if(session()->get('isLoggedIn')): ?>
                    <!-- Se Logado: Mostra nome e botão Sair -->
                    <span class="fw-bold mx-2">Olá, <?= strtok(session()->get('nome'), " ") ?>!</span>
                    <a href="<?= base_url('logout') ?>" class="btn btn-danger">
                        Sair <span class="fa-solid fa-right-from-bracket ms-1"></span>
                    </a>
                <?php else: ?>
                    <!-- Se NÃO Logado: Mostra botão Login -->
                    <a href="<?= base_url('login') ?>" class="btn btn-outline-primary">
                        Login
                    </a>
                <?php endif; ?>

            </div>
        </div>
    </div>
</nav>