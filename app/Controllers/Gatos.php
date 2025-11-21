<?php

namespace App\Controllers;

use App\Models\GatoModel;
use \App\Models\SolicitacaoModel;

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

        $dados = [
            'usuario_id'    => session()->get('id'),
            'nome'          => $this->request->getPost('nome'),
            'idade'         => $this->request->getPost('idade'),
            'descricao'     => $this->request->getPost('descricao'),
            'foto'          => $fotoFinal,
            'adotado'       => GatoModel::DISPONIVEL,
        ];

        if ($model->save($dados)) {
            return redirect()->to('/')->with('msg-success', 'Gato cadastrado com sucesso!');
        } else {
            return redirect()->back()->with('msg', 'Erro ao salvar.');
        }
    }

    public function editar()
    {
        $model = new GatoModel();

        $id = $this->request->getPost('id');
        $userId = session()->get('id');

        $gatoAtual = $model->where('id', $id)->where('usuario_id', $userId)->first();

        if (!$gatoAtual) {
            return redirect()->back()->with('msg', 'Erro: Gato não encontrado ou sem permissão.');
        }

        $fotoFinal = $gatoAtual['foto'];

        $img = $this->request->getFile('arquivo_foto');
        $link = $this->request->getPost('url_foto');
        $tipo = $this->request->getPost('tipo_foto_radio');

        if ($tipo === 'upload' && $img && $img->isValid() && !$img->hasMoved()) {
            $novoNome = $img->getRandomName();
            $img->move(FCPATH . 'uploads', $novoNome);
            $fotoFinal = 'uploads/' . $novoNome;
        } elseif ($tipo === 'link' && !empty($link)) {
            $fotoFinal = $link;
        }

        $dados = [
            'nome'       => $this->request->getPost('nome'),
            'idade'      => $this->request->getPost('idade'),
            'descricao'  => $this->request->getPost('descricao'),
            'foto'       => $fotoFinal
        ];

        $model->update($id, $dados);

        return redirect()->back()->with('msg-success', 'Dados do gatinho atualizados!');
    }

    public function meusGatos()
    {
        $model = new GatoModel();
        $userId = session()->get('id');

        $meusGatos = $model->where('usuario_id', $userId)->orderBy('id', 'DESC')->paginate(10);

        $data = [
            'titulo' => 'Gerenciar Meus Gatos',
            'gatos'  => $meusGatos,
            'pager'  => $model->pager
        ];

        echo view('commons/header', $data);
        echo view('commons/navbar');
        echo view('meus_gatos', $data);
        echo view('commons/footer');
    }


    public function excluir($id)
    {
        $model = new GatoModel();
        $userId = session()->get('id');

        $gato = $model->where('id', $id)->where('usuario_id', $userId)->first();

        if ($gato) {
            $model->delete($id);
            return redirect()->back()->with('msg-success', 'Gatinho excluído com sucesso.');
        } else {
            return redirect()->back()->with('msg', 'Operação não permitida.');
        }
    }

    public function alternarStatus($id)
    {
        $model = new GatoModel();
        $userId = session()->get('id');

        $gato = $model->where('id', $id)->where('usuario_id', $userId)->first();

        if ($gato) {
            $novoStatus = $gato['adotado'] == GatoModel::ADOTADO ? GatoModel::DISPONIVEL : GatoModel::ADOTADO;

            $model->update($id, ['adotado' => $novoStatus]);

            $msg = $novoStatus ? 'Marcado como Adotado!' : 'Marcado como Disponível novamente.';
            return redirect()->back()->with('msg-success', $msg);
        }
        return redirect()->back()->with('msg', 'Erro ao atualizar status.');
    }

    public function adocao()
    {
        $model = new GatoModel();
        $solicModel = new SolicitacaoModel();

        $idsSolicitados = [];

        if (session()->get('isLoggedIn')) {
            $solicitacoes = $solicModel->select('gato_id')
                ->where('adotante_id', session()->get('id'))
                ->whereIn('status', ['pendente', 'concluida'])
                ->findAll();

            $idsSolicitados = array_column($solicitacoes, 'gato_id');
        }

        $data = [
            'titulo' => 'Adoção - MiauLar',
            'gatos'  => $model->where('adotado', 0)->orderBy('id', 'DESC')->paginate(8),
            'pager'  => $model->pager,
            'idsSolicitados' => $idsSolicitados
        ];

        echo view('commons/header', $data);
        echo view('commons/navbar');
        echo view('adocao', $data);
        echo view('commons/footer');
    }
}
