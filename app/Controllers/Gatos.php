<?php

namespace App\Controllers;

use App\Models\GatoModel;

class Gatos extends BaseController
{

    public function novo()
    {
        // Graças ao Filtro, só chega aqui se estiver logado
        return view('adicionar_gato');
    }

    public function salvar()
    {
        $model = new GatoModel();

        // Upload da Imagem
        $img = $this->request->getFile('foto');
        $nomeFoto = '';

        if ($img->isValid() && !$img->hasMoved()) {
            $nomeFoto = $img->getRandomName();
            $img->move('uploads/', $nomeFoto); // Move para public/uploads
        }

        $dados = [
            'usuario_id' => session()->get('id'), // ID do usuário da sessão
            'nome'       => $this->request->getPost('nome'),
            'idade'      => $this->request->getPost('idade'),
            'descricao'  => $this->request->getPost('descricao'),
            'foto'       => $nomeFoto
        ];

        $model->save($dados);
        return redirect()->to('/');
    }

    public function adocao()
    {
        $data = [
            'titulo' => 'Gatos para Adoção - MiauLar'
        ];

        echo view('commons/header', $data);
        echo view('adocao');
    }
}
