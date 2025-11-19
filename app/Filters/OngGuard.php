<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class OngGuard implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Primeiro verifica se está logado
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        // Verifica se o perfil é ONG
        if (session()->get('perfil') !== 'ong') {
            // Redireciona para home com mensagem de erro
            return redirect()->to('/')->with('msg', 'Acesso exclusivo para ONGs.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null){}
}