<?php

use yii\db\Schema;
use yii\db\Migration;

class m150218_185208_add_expert_assessment_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
          // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
          $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%expert_assessment_history}}', [
            'id' => Schema::TYPE_PK,
            'start_date' => Schema::TYPE_DATE . ' NOT NULL',
            'amount' => Schema::TYPE_DECIMAL . '(15,2)',
            'square' => Schema::TYPE_DECIMAL . '(15,2)',
            'contract_additions_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            
            'created_at' => Schema::TYPE_INTEGER,
            'updated_at' => Schema::TYPE_INTEGER,
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%expert_assessment_history}}');
    }
}
