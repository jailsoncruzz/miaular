<?php

namespace App\Models;

use CodeIgniter\Model;

class SolicitacaoModel extends Model
{
    protected $table = 'solicitacoes';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'gato_id',
        'adotante_id',
        'protetor_id',
        'status',
        'contato_liberado',
        'updated_at'
    ];

    protected $useTimestamps = true;
}
