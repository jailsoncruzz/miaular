<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddStatusSoftDeleteToGatos extends Migration
{
    public function up()
    {
        $fields = [
            'adotado' => [
                'type'    => 'TINYINT',
                'constraint' => 1,
                'default' => 0, // 0 = Disponível, 1 = Adotado
                'after'   => 'foto'
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
                'after' => 'updated_at'
            ],
        ];
        $this->forge->addColumn('gatos', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('gatos', ['adotado', 'deleted_at']);
    }
}