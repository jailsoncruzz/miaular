<?php namespace App\Filters;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class GestorGuard implements FilterInterface {
    public function before(RequestInterface $request, $arguments = null) {
        // 1. Verifica login
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }
        // 2. Verifica se é ONG ou Protetor
        $perfil = session()->get('perfil');
        if (!in_array($perfil, ['ong', 'protetor'])) {
            // Se for adotante tentando entrar, manda pra home
            return redirect()->to('/')->with('msg', 'Acesso restrito a ONGs e Protetores.');
        }
    }
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {}
}