<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUser extends Migration {

    public function up() {
        $this->forge->addField([
            'id'         => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => TRUE,
                'auto_increment' => TRUE,
            ],
            'name'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'username'   => [
                'type' => 'TEXT',
            ],
            'email'      => [
                'type' => 'TEXT',
            ],
            'password'   => [
                'type' => 'TEXT',
            ],
            'roles'      => [
                'type'       => 'ENUM',
                'constraint' => ['0', '1', '2'],
                'default'    => '0',
            ],
            'last_login' => [
                'type' => 'DATE',
            ],
            'deleted_at' => [
                'type' => 'DATE',
                'null' => TRUE,
            ],
        ]);
        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('users');
    }

    //--------------------------------------------------------------------

    public function down() {
        $this->forge->dropTable('users');
    }
}
