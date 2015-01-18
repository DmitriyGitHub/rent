<?php

use yii\db\Schema;
use yii\db\Migration;

class m150118_125221_add_accruals_table extends Migration
{
  public function up()
  {
    $tableOptions = null;
    if ($this->db->driverName === 'mysql') {
      // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
      $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
    }

    $this->createTable('{{%accruals}}', [
        'id' => Schema::TYPE_PK,
        'date' => Schema::TYPE_DATE,
        'amount' => Schema::TYPE_DECIMAL . '(15,2) NOT NULL',
        'contract_id' => Schema::TYPE_INTEGER,
        'service_id' => Schema::TYPE_INTEGER,
        
        'created_at' => Schema::TYPE_INTEGER,
        'updated_at' => Schema::TYPE_INTEGER,
    ], $tableOptions);
    
    $this->addForeignKey('FK_accrual_service', 'accruals', 'service_id', 'services_type', 'id', 'CASCADE', 'NO ACTION');
    $this->addForeignKey('FK_accrual_contract', 'accruals', 'contract_id', 'contracts', 'id', 'CASCADE', 'NO ACTION');

  }

    public function down()
    {
        $this->dropForeignKey('FK_accrual_service', 'accruals');
        $this->dropForeignKey('FK_accrual_contract', 'accruals');
        $this->dropTable('{{%accruals}}');
    }
}
