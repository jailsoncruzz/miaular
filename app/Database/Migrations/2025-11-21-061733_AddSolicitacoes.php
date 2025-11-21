<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddSolicitacoes extends Migration
{
    public function up()
    {
        // Tabela de Solicitações (O "Ticket" de adoção)
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'gato_id' => ['type' => 'INT', 'unsigned' => true],
            'adotante_id' => ['type' => 'INT', 'unsigned' => true],
            'protetor_id' => ['type' => 'INT', 'unsigned' => true],
            'status' => ['type' => 'ENUM', 'constraint' => ['pendente', 'concluida', 'recusada'], 'default' => 'pendente'],
            'contato_liberado' => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 0],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('gato_id', 'gatos', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('solicitacoes');

        // Tabela de Mensagens (O histórico do chat)
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'solicitacao_id' => ['type' => 'INT', 'unsigned' => true],
            'remetente_id' => ['type' => 'INT', 'unsigned' => true], 
            'mensagem' => ['type' => 'TEXT'],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('solicitacao_id', 'solicitacoes', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('mensagens');
    }

    public function down()
    {
        $this->forge->dropTable('mensagens');
        $this->forge->dropTable('solicitacoes');
    }
}