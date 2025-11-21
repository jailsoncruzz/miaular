<?php namespace App\Controllers;

use App\Models\GatoModel;

class Home extends BaseController
{
    public function index()
    {
        $model = new GatoModel();

        $data = [
            'titulo' => 'Home - MiauLar',
            'gatos'  => $model->where('adotado', GatoModel::DISPONIVEL)->orderBy('id', 'DESC')->findAll(6),
        ];

        echo view('commons/header', $data);
        echo view('commons/navbar');
        echo view('home', $data);
        echo view('commons/footer');
    }
}