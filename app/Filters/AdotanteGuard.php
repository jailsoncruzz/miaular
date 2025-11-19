<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AdotanteGuard implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        if (session()->get('perfil') !== 'adotante') {
            return redirect()->to('/')->with('msg', 'Acesso exclusivo para Adotantes.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null){}
}