<?php namespace App\Models;
use CodeIgniter\Model;

class GatoModel extends Model {
    protected $table = 'gatos';
    protected $primaryKey = 'id';
    protected $allowedFields = ['usuario_id', 'nome', 'idade', 'descricao', 'foto'];
    protected $useTimestamps = true;
}