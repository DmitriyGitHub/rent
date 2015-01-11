<?php

use yii\db\Schema;
use yii\db\Migration;

class m150111_182647_add_organisations_table extends Migration
{
  public function up()
  {
    $tableOptions = null;
    if ($this->db->driverName === 'mysql') {
      // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
      $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
    }

    $this->createTable('{{%organisations}}', [
      'id' => Schema::TYPE_PK,
      'name' => Schema::TYPE_STRING . ' NOT NULL COMMENT \'Organisation name\'',
      'okpo' => Schema::TYPE_STRING . ' COMMENT \'Organisation OKPO\'',
      'legal_address' => Schema::TYPE_STRING . ' COMMENT \'Organisation legal address\'',
      'real_address' => Schema::TYPE_STRING . ' COMMENT \'Organisation real address\'',

      'budget_org' => Schema::TYPE_BOOLEAN . ' COMMENT \'Budget organisation\'',
      'general_org' => Schema::TYPE_BOOLEAN . ' COMMENT \'General organisation\'',
      'vat_payer' => Schema::TYPE_BOOLEAN . ' COMMENT \'VAT payment organisation\'',
      'self_org' => Schema::TYPE_BOOLEAN . ' COMMENT \'Self organisation\'',

      'status' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 10',
      'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
      'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
    ], $tableOptions);

  }

  public function down()
  {
    $this->dropTable('{{%organisations}}');
  }
}
