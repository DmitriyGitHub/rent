<?php

use yii\db\Schema;
use yii\db\Migration;

class m150118_125832_add_payments_table extends Migration
{
  public function up()
  {
    $tableOptions = null;
    if ($this->db->driverName === 'mysql') {
      // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
      $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
    }

    $this->createTable('{{%payments}}', [
        'id' => Schema::TYPE_PK,
        'number' => Schema::TYPE_STRING,
        'date' => Schema::TYPE_DATE,
        'amount' => Schema::TYPE_DECIMAL . '(15,2) NOT NULL',
        'contract_id' => Schema::TYPE_INTEGER,
        'type_id' => Schema::TYPE_INTEGER,
        'service_id' => Schema::TYPE_INTEGER,
        
        'created_at' => Schema::TYPE_INTEGER,
        'updated_at' => Schema::TYPE_INTEGER,
    ], $tableOptions);
    
    $this->addForeignKey('FK_payment_type', 'payments', 'type_id', 'payments_type', 'id', 'CASCADE', 'NO ACTION');
    $this->addForeignKey('FK_payment_service', 'payments', 'service_id', 'services_type', 'id', 'CASCADE', 'NO ACTION');
    $this->addForeignKey('FK_payment_contract', 'payments', 'contract_id', 'contracts', 'id', 'CASCADE', 'NO ACTION');

  }

    public function down()
    {
        $this->dropForeignKey('FK_payment_type', 'payments');
        $this->dropForeignKey('FK_payment_service', 'payments');
        $this->dropForeignKey('FK_payment_contract', 'payments');
        $this->dropTable('{{%payments}}');
    }
}
