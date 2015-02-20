<?php

use yii\db\Schema;
use yii\db\Migration;

class m150219_194311_add_contract_addition_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
          // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
          $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%contract_additions}}', [
            'id' => Schema::TYPE_PK,
            'date' => Schema::TYPE_DATE,
            'contract_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'number' => Schema::TYPE_STRING . ' COMMENT \'Contract addition number\'',
            'description' => Schema::TYPE_STRING,

            'created_at' => Schema::TYPE_INTEGER,
            'updated_at' => Schema::TYPE_INTEGER,
        ], $tableOptions);

        $this->addForeignKey('FK_contract_additions_contract', 'contract_additions', 'contract_id', 'contracts', 'id', 'CASCADE', 'NO ACTION');
        $this->addForeignKey('FK_percentage_history_addition', 'percentage_history', 'contract_additions_id', 'contract_additions', 'id', 'CASCADE', 'NO ACTION');
        $this->addForeignKey('FK_expert_assessment_history_addition', 'expert_assessment_history', 'contract_additions_id', 'contract_additions', 'id', 'CASCADE', 'NO ACTION');
        $this->addForeignKey('FK_contract_price_history_addition', 'contract_price_history', 'contract_additions_id', 'contract_additions', 'id', 'CASCADE', 'NO ACTION');
    }

    public function down()
    {
        $this->dropForeignKey('FK_contract_additions_contract', 'contract_additions');
        $this->dropForeignKey('FK_percentage_history_addition', 'percentage_history');
        $this->dropForeignKey('FK_expert_assessment_history_addition', 'expert_assessment_history');
        $this->dropForeignKey('FK_contract_price_history_addition', 'contract_price_history');
        $this->dropTable('{{%contract_additions}}');
    }
}
