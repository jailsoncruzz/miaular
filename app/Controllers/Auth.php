<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

class Auth extends BaseController
{
    
    public function login()
    {
        if (session()->get('isLoggedIn')) return redirect()->to('/');

        $data = ['titulo' => 'Login - MiauLar'];
        
        echo view('commons/header', $data);
        echo view('commons/navbar_login');
        echo view('login');
        echo view('commons/footer');
    }

    public function autenticar()
    {
        $session = session();
        $model = new UsuarioModel();
        
        $email = $this->request->getPost('email');
        $senha = $this->request->getPost('senha');
        
        $user = $model->where('email', $email)->first();
        
        if ($user) {
            if (password_verify($senha, $user['senha'])) {
                $ses_data = [
                    'id'         => $user['id'],
                    'nome'       => $user['nome'],
                    'email'      => $user['email'],
                    'perfil'     => $user['perfil'],
                    'isLoggedIn' => TRUE
                ];
                $session->set($ses_data);
                return redirect()->to('/');
            } else {
                $session->setFlashdata('msg', 'Senha incorreta.');
                return redirect()->to('/login');
            }
        } else {
            $session->setFlashdata('msg', 'Email não cadastrado.');
            return redirect()->to('/login');
        }
    }


    public function cadastro()
    {
        if (session()->get('isLoggedIn')) return redirect()->to('/');

        $data = ['titulo' => 'Criar Conta - MiauLar'];

        echo view('commons/header', $data);
        echo view('commons/navbar_login', $data);
        echo view('cadastro');
        echo view('commons/footer');
    }

    public function salvar()
    {
        $model = new UsuarioModel();

        $regras = [
            'perfil'   => [
                'rules'  => 'required|in_list[adotante,protetor,ong]',
                'errors' => ['in_list' => 'Selecione um tipo de perfil válido.']
            ],
            'nome'     => [
                'rules'  => 'required|min_length[3]',
                'errors' => ['min_length' => 'O nome deve ter pelo menos 3 letras.']
            ],
            'email'    => [
                'rules'  => 'required|valid_email|is_unique[usuarios.email]',
                'errors' => [
                    'valid_email' => 'Por favor, digite um email válido.',
                    'is_unique'   => 'Este email já está cadastrado no sistema.'
                ]
            ],
            'telefone' => [
                'rules' => 'required',
                'errors' => ['required' => 'O telefone é obrigatório.']
            ],
            'senha'    => [
                'rules'  => 'required|min_length[6]',
                'errors' => ['min_length' => 'A senha deve ter no mínimo 6 caracteres.']
            ]
        ];

        if (!$this->validate($regras)) {
            // FALHA: Volta para o cadastro com os erros e os dados preenchidos
            return redirect()->to('/cadastro')->withInput()->with('errors', $this->validator->getErrors());
        }

        $dados = [
            'nome'     => $this->request->getPost('nome'),
            'email'    => $this->request->getPost('email'),
            'telefone' => $this->request->getPost('telefone'),
            'perfil'   => $this->request->getPost('perfil'),
            'senha'    => $this->request->getPost('senha'),
        ];

        $model->save($dados);

        return redirect()->to('/login')->with('msg-success', 'Cadastro realizado com sucesso! Faça login para entrar.');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}