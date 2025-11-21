<?php namespace App\Models;
use CodeIgniter\Model;

class MensagemModel extends Model {
    protected $table = 'mensagens';
    protected $primaryKey = 'id';
    protected $allowedFields = ['solicitacao_id', 'remetente_id', 'mensagem'];
    protected $useTimestamps = true;
    protected $updatedField  = '';
}