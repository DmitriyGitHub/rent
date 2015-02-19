<?php

use yii\db\Schema;
use yii\db\Migration;

class m150218_185837_add_percentage_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
          // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
          $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%percentage_history}}', [
            'id' => Schema::TYPE_PK,
            'start_date' => Schema::TYPE_DATE . ' NOT NULL',
            'amount' => Schema::TYPE_DECIMAL . '(15,2) NOT NULL',
            'use_purpose' => Schema::TYPE_STRING,
            'contract_additions_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            
            'created_at' => Schema::TYPE_INTEGER,
            'updated_at' => Schema::TYPE_INTEGER,
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%percentage_history}}');
    }
}
