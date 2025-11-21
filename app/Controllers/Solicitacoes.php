<?php

namespace App\Controllers;

use App\Models\SolicitacaoModel;
use App\Models\MensagemModel;
use App\Models\GatoModel;

class Solicitacoes extends BaseController
{
    public function index()
    {
        $model = new SolicitacaoModel();
        $userId = session()->get('id');

        $solicitacoes = $model->select('solicitacoes.*, gatos.nome as nome_gato, gatos.foto as foto_gato, usuarios.nome as nome_interessado, usuarios.perfil as perfil_interessado')
            ->join('gatos', 'gatos.id = solicitacoes.gato_id')
            ->join('usuarios', 'usuarios.id = IF(solicitacoes.protetor_id = ' . $userId . ', solicitacoes.adotante_id, solicitacoes.protetor_id)')
            ->groupStart()
            ->where('adotante_id', $userId)
            ->orWhere('protetor_id', $userId)
            ->groupEnd()
            ->orderBy('status', 'ASC')
            ->orderBy('updated_at', 'DESC')
            ->findAll();

        $data = [
            'titulo' => 'Solicitações de Adoção',
            'solicitacoes' => $solicitacoes
        ];

        echo view('commons/header', $data);
        echo view('commons/navbar');
        echo view('lista_solicitacoes', $data);
        echo view('commons/footer');
    }

    public function criar()
    {
        $solicitacaoModel = new SolicitacaoModel();
        $mensagemModel = new MensagemModel();

        $adotanteId = session()->get('id');
        $gatoId = $this->request->getPost('gato_id');
        $protetorId = $this->request->getPost('protetor_id');
        $texto = $this->request->getPost('mensagem');

        $existe = $solicitacaoModel->where('gato_id', $gatoId)
                                   ->where('adotante_id', $adotanteId)
                                   ->where('status !=', 'recusada')
                                   ->first();
        if($existe){
            return redirect()->back()->with('msg', 'Você já possui uma solicitação em andamento para este gatinho.');
        }

        $solicitacaoId = $solicitacaoModel->insert([
            'gato_id' => $gatoId,
            'adotante_id' => $adotanteId,
            'protetor_id' => $protetorId,
            'status' => 'pendente'
        ]);

        $mensagemModel->insert([
            'solicitacao_id' => $solicitacaoId,
            'remetente_id' => $adotanteId,
            'mensagem' => $texto
        ]);

        return redirect()->to('solicitacoes/chat/' . $solicitacaoId)->with('msg-success', 'Solicitação enviada!');
    }

    public function chat($id)
    {
        $solicitacaoModel = new SolicitacaoModel();
        $mensagemModel = new MensagemModel();
        $userId = session()->get('id');

        $solicitacao = $solicitacaoModel->select('solicitacoes.*, gatos.nome as nome_gato, gatos.foto as foto_gato, u1.nome as nome_adotante, u1.email as email_adotante, u1.telefone as tel_adotante, u2.nome as nome_protetor, u2.email as email_protetor, u2.telefone as tel_protetor')
            ->join('gatos', 'gatos.id = solicitacoes.gato_id')
            ->join('usuarios u1', 'u1.id = solicitacoes.adotante_id')
            ->join('usuarios u2', 'u2.id = solicitacoes.protetor_id')
            ->where('solicitacoes.id', $id)
            ->first();

        if (!$solicitacao || ($solicitacao['adotante_id'] != $userId && $solicitacao['protetor_id'] != $userId)) {
            return redirect()->to('/')->with('msg', 'Acesso negado.');
        }

        $mensagens = $mensagemModel->where('solicitacao_id', $id)->orderBy('created_at', 'ASC')->findAll();

        $data = [
            'titulo' => 'Chat de Adoção',
            'solicitacao' => $solicitacao,
            'mensagens' => $mensagens,
            'euSouProtetor' => ($solicitacao['protetor_id'] == $userId)
        ];

        echo view('commons/header', $data);
        echo view('commons/navbar');
        echo view('chat_adocao', $data);
        echo view('commons/footer');
    }

    public function responder()
    {
        $model = new MensagemModel();
        $solicitacaoModel = new SolicitacaoModel();

        $solicitacaoId = $this->request->getPost('solicitacao_id');
        $userId = session()->get('id');
        $texto = $this->request->getPost('mensagem');

        // Segurança básica
        $solicitacao = $solicitacaoModel->find($solicitacaoId);
        if ($solicitacao['status'] != 'pendente') {
            return redirect()->back()->with('msg', 'Esta solicitação já foi finalizada.');
        }

        $model->insert([
            'solicitacao_id' => $solicitacaoId,
            'remetente_id' => $userId,
            'mensagem' => $texto
        ]);

        $solicitacaoModel->update($solicitacaoId, ['updated_at' => date('Y-m-d H:i:s')]);

        return redirect()->to('solicitacoes/chat/' . $solicitacaoId);
    }

    public function gerenciar()
    {
        $solicitacaoModel = new SolicitacaoModel();
        $gatoModel = new GatoModel();

        $id = $this->request->getPost('solicitacao_id');
        $acao = $this->request->getPost('acao');
        $userId = session()->get('id');

        $solicitacao = $solicitacaoModel->find($id);

        if ($solicitacao['protetor_id'] != $userId) return redirect()->back();

        if ($acao === 'liberar_contato') {
            $solicitacaoModel->update($id, ['contato_liberado' => 1]);
            return redirect()->back()->with('msg-success', 'Seu contato foi liberado para o adotante!');
        }

        if ($acao === 'recusar') {
            $solicitacaoModel->update($id, ['status' => 'recusada']);
            return redirect()->back()->with('msg', 'Adoção recusada e fechada.');
        }

        if ($acao === 'concluir') {
            $solicitacaoModel->update($id, ['status' => 'concluida']);

            $gatoModel->update($solicitacao['gato_id'], ['adotado' => 1]);

            $solicitacaoModel->where('gato_id', $solicitacao['gato_id'])
                ->where('status', 'pendente')
                ->set(['status' => 'recusada'])
                ->update();

            return redirect()->back()->with('msg-success', 'Parabéns! Adoção realizada com sucesso.');
        }
    }
}
