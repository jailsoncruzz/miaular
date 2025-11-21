<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


$routes->get('/', 'Home::index');
$routes->get('login', 'Auth::login');
$routes->post('login/autenticar', 'Auth::autenticar');
$routes->get('cadastro', 'Auth::cadastro');
$routes->post('cadastro/salvar', 'Auth::salvar');
$routes->get('logout', 'Auth::logout');

$routes->group('', ['filter' => 'auth'], function ($routes) {

    $routes->get('gatos/adocao', 'Gatos::adocao');

    $routes->group('perfil', function ($routes) {
        $routes->get('editar', 'Usuario::editar');
        $routes->post('salvar', 'Usuario::salvar');
    });

    $routes->group('solicitacoes', function ($routes) {
        $routes->get('/', 'Solicitacoes::index'); 
        $routes->post('criar', 'Solicitacoes::criar'); 
        $routes->get('chat/(:num)', 'Solicitacoes::chat/$1'); 
        $routes->post('responder', 'Solicitacoes::responder'); 
        $routes->post('gerenciar', 'Solicitacoes::gerenciar'); 
    });
});


// O filtro 'gestor' bloqueia Adotantes e Visitantes.
$routes->group('gatos', ['filter' => 'gestor'], function ($routes) {

    $routes->post('salvar', 'Gatos::salvar');
    $routes->post('editar', 'Gatos::editar');

    $routes->get('meus-gatos', 'Gatos::meusGatos');
    $routes->get('excluir/(:num)', 'Gatos::excluir/$1');
    $routes->get('status/(:num)', 'Gatos::alternarStatus/$1');
});
