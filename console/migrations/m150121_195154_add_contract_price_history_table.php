<?php

use yii\db\Schema;
use yii\db\Migration;

class m150121_195154_add_contract_price_history_table extends Migration
{
  public function up()
  {
    $tableOptions = null;
    if ($this->db->driverName === 'mysql') {
      // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
      $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
    }

    $this->createTable('{{%contract_price_history}}', [
        'id' => Schema::TYPE_PK,
        'date' => Schema::TYPE_DATE,
        'amount' => Schema::TYPE_DECIMAL . '(15,2) NOT NULL',
        'contract_additions_id' => Schema::TYPE_INTEGER . ' NOT NULL',
        
        'created_at' => Schema::TYPE_INTEGER,
        'updated_at' => Schema::TYPE_INTEGER,
    ], $tableOptions);

  }

    public function down()
    {
        $this->dropForeignKey('FK_contract_price_history_contract', 'contract_price_history');
        $this->dropTable('{{%contract_price_history}}');
    }
}
