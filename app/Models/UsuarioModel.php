<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table = 'usuarios';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nome', 'email', 'telefone', 'senha', 'perfil'];
    protected $useTimestamps = true;


    protected $beforeInsert = ['hashSenha'];
    protected $beforeUpdate = ['hashSenha'];

    protected function hashSenha(array $data)
    {
        // Só faz o hash se a senha foi enviada no array de dados
        if (isset($data['data']['senha']) && !empty($data['data']['senha'])) {
            $data['data']['senha'] = password_hash($data['data']['senha'], PASSWORD_DEFAULT);
        }
        return $data;
    }
}
