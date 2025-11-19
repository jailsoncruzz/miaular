<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Rotas de Autenticação
$routes->get('login', 'Auth::login');
$routes->post('login/autenticar', 'Auth::autenticar');
$routes->get('cadastro', 'Auth::cadastro');
$routes->post('cadastro/salvar', 'Auth::salvar');
$routes->get('logout', 'Auth::logout');

// --- ROTAS GERAIS (Qualquer usuário LOGADO) ---
// O filtro 'auth' verifica se está logado. Se não, manda para login.
$routes->group('', ['filter' => 'auth'], function ($routes) {

    // Botão "Adoção" do menu vai para cá
    $routes->get('gatos/adocao', 'Gatos::adocao');

    // Edição de perfil do usuário
    $routes->get('perfil/editar', 'Usuario::editar');
});


// --- ROTAS DE GESTÃO DE GATOS (Apenas ONG ou Protetor) ---
// O filtro 'gestor' deve permitir apenas perfis 'ong' e 'protetor'.
// O botão "Adicionar" do menu vai para 'gatos/adicionar'.
// GRUPO PROTEGIDO (Se tentar acessar sem logar, o filtro 'auth' joga pro Login)
$routes->group('gatos', ['filter' => 'auth'], function($routes) {
    $routes->get('adicionar', 'Gatos::novo');   // Botão Adicionar leva aqui
    $routes->post('salvar', 'Gatos::salvar');
    $routes->get('adocao', 'Gatos::adocao'); // Botão Adoção leva aqui
});
