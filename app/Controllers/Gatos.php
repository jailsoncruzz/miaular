<?php

namespace App\Controllers;

use App\Models\GatoModel;

class Gatos extends BaseController
{

    public function novo()
    {
        return view('adicionar');
    }

    public function salvar()
    {
        $model = new GatoModel();
        $fotoFinal = '';

        $img = $this->request->getFile('arquivo_foto');

        if ($img && $img->isValid() && !$img->hasMoved()) {

            $novoNome = $img->getRandomName();

            $img->move(FCPATH . 'uploads', $novoNome);

            $fotoFinal = 'uploads/' . $novoNome;
        } else {
            $link = $this->request->getPost('url_foto');

            if (!empty($link)) {
                $fotoFinal = $link;
            } else {
                $fotoFinal = 'imgs/sem-foto.jpg';
            }
        }

        // 3. Salva no Banco
        $dados = [
            'usuario_id' => session()->get('id'),
            'nome'       => $this->request->getPost('nome'),
            'idade'      => $this->request->getPost('idade'),
            'descricao'  => $this->request->getPost('descricao'),
            'foto'       => $fotoFinal
        ];

        if ($model->save($dados)) {
            return redirect()->to('/')->with('msg-success', 'Gato cadastrado com sucesso!');
        } else {
            return redirect()->back()->with('msg', 'Erro ao salvar.');
        }
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
