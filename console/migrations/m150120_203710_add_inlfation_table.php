<?php

use yii\db\Schema;
use yii\db\Migration;

class m150120_203710_add_inlfation_table extends Migration
{
  public function up()
  {
    $tableOptions = null;
    if ($this->db->driverName === 'mysql') {
      // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
      $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
    }

    $this->createTable('{{%inflation}}', [
        'id' => Schema::TYPE_PK,
        'date' => Schema::TYPE_DATE,
        'amount' => Schema::TYPE_DECIMAL . '(15,2) NOT NULL',
        
        'created_at' => Schema::TYPE_INTEGER,
        'updated_at' => Schema::TYPE_INTEGER,
    ], $tableOptions);
  }

    public function down()
    {
        $this->dropTable('{{%inflation}}');
    }
}
