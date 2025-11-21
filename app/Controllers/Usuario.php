<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

class Usuario extends BaseController
{
    public function editar()
    {
        $model = new UsuarioModel();
        $idUsuario = session()->get('id');

        $usuario = $model->find($idUsuario);

        if (!$usuario) {
            return redirect()->to('/logout');
        }

        $data = [
            'titulo'  => 'Editar Perfil - MiauLar',
            'usuario' => $usuario
        ];

        echo view('commons/header', $data);
        echo view('commons/navbar');
        echo view('perfil_editar', $data); // View que criaremos a seguir
        echo view('commons/footer');
    }

    public function salvar()
    {
        $model = new UsuarioModel();
        $idUsuario = session()->get('id');

        $rules = [
            'nome'     => 'required|min_length(3)',
            'telefone' => 'required',
            'email'    => "required|valid_email|is_unique[usuarios.email,id,{$idUsuario}]",
        ];

        $novaSenha = $this->request->getPost('senha');
        if (!empty($novaSenha)) {
            $rules['senha'] = 'min_length(6)';
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $dados = [
            'nome'     => $this->request->getPost('nome'),
            'email'    => $this->request->getPost('email'),
            'telefone' => $this->request->getPost('telefone'),
        ];

        if (!empty($novaSenha)) {
            $dados['senha'] = $novaSenha;
        }

        if ($model->update($idUsuario, $dados)) {

            session()->set([
                'nome'  => $dados['nome'],
                'email' => $dados['email']
            ]);

            return redirect()->to('perfil/editar')->with('msg-success', 'Dados atualizados com sucesso!');
        } else {
            return redirect()->back()->with('msg', 'Erro ao atualizar dados.');
        }
    }
}
