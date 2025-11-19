<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data = ['titulo' => 'Home - MiauLar'];

        echo view('commons/header', $data);
        echo view('home'); // Conteúdo da home
    }
}
