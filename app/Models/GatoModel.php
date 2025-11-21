<?php namespace App\Models;
use CodeIgniter\Model;

class GatoModel extends Model {
    CONST DISPONIVEL = 0;
    CONST ADOTADO = 1;

    CONST STATUS_ADOCAO = [
        self::DISPONIVEL    => 'Adotado', 
        self::ADOTADO       => 'Disponivel',
    ];

    protected $table = 'gatos';
    protected $primaryKey = 'id';
    
    protected $allowedFields = [
        'usuario_id', 
        'nome', 
        'idade', 
        'descricao', 
        'foto', 
        'adotado'
    ];
    
    protected $useTimestamps = true;

    protected $useSoftDeletes = true; 
    protected $deletedField  = 'deleted_at';
}