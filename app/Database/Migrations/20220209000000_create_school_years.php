<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSchoolYears extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'is_latest' => [
                'type' => 'BOOLEAN',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('school_years');
    }

    public function down()
    {
        $this->forge->dropTable('school_years');
    }
}