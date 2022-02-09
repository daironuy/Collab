<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateDepartmentMembers extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'user_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'department_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'is_user_admin' => [
                'type' => 'BOOLEAN',
            ],
        ]);
        $this->forge->createTable('department_members');
    }

    public function down()
    {
        $this->forge->dropTable('department_members');
    }
}