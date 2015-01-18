<?php

use yii\db\Schema;
use yii\db\Migration;

class m150117_191950_add_contract_table extends Migration
{
  public function up()
  {
    $tableOptions = null;
    if ($this->db->driverName === 'mysql') {
      // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
      $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
    }

    $this->createTable('{{%contracts}}', [
        'id' => Schema::TYPE_PK,
        'number' => Schema::TYPE_STRING . ' NOT NULL',
        'date' => Schema::TYPE_DATE,
        'start_date' => Schema::TYPE_DATE,
        'end_date' => Schema::TYPE_DATE,
        'object_id' => Schema::TYPE_INTEGER,
        'organisation_id' => Schema::TYPE_INTEGER,
        
        'status' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 10',
        'contract_type' => Schema::TYPE_INTEGER,
        'square' => Schema::TYPE_DECIMAL . '(15,4)',
        'descriptions' => Schema::TYPE_STRING,
        'initial_price' => Schema::TYPE_DECIMAL . '(15,2)',
        'account_number' => Schema::TYPE_STRING,
        'object_part_id' => Schema::TYPE_INTEGER,
        'object_part_additional' => Schema::TYPE_STRING,
        
        'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
        'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
    ], $tableOptions);
    
    $this->addForeignKey('FK_contracts_contract_type', 'contracts', 'contract_type', 'contracts_type', 'id', 'CASCADE', 'NO ACTION');
    $this->addForeignKey('FK_contracts_organisation', 'contracts', 'organisation_id', 'organisations', 'id', 'CASCADE', 'NO ACTION');
    $this->addForeignKey('FK_contracts_object', 'contracts', 'object_id', 'objects', 'id', 'CASCADE', 'NO ACTION');

  }

    public function down()
    {
        $this->dropForeignKey('FK_contracts_contract_type', 'contracts');
        $this->dropForeignKey('FK_contracts_organisation', 'contracts');
        $this->dropForeignKey('FK_contracts_object', 'contracts');
        $this->dropTable('{{%contracts}}');
    }
}
