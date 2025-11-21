<?php namespace App\Controllers;

use App\Models\GatoModel;

class Home extends BaseController
{
    public function index()
    {
        $model = new GatoModel();

        $data = [
            'titulo' => 'Home - MiauLar',
            'gatos'  => $model->orderBy('id', 'DESC')->paginate(6),
            'pager'  => $model->pager
        ];

        echo view('commons/header', $data);
        echo view('commons/navbar');
        echo view('home', $data); // A view home agora recebe $gatos e $pager
        echo view('commons/footer');
    }
}