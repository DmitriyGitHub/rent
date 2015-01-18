<?php

use yii\db\Schema;
use yii\db\Migration;

class m150111_174454_add_payments_table extends Migration
{
  public function up()
  {
    $tableOptions = null;
    if ($this->db->driverName === 'mysql') {
      // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
      $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
    }

    $this->createTable('{{%payments_type}}', [
      'id' => Schema::TYPE_PK,
      'name' => Schema::TYPE_STRING . ' NOT NULL COMMENT \'Payment type name\'',
      'description' => Schema::TYPE_STRING . ' NOT NULL COMMENT \'Payment type description\'',

      'status' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 10',
      'created_at' => Schema::TYPE_INTEGER,
      'updated_at' => Schema::TYPE_INTEGER,
    ], $tableOptions);
  }

  public function down()
  {
    $this->dropTable('{{%payments_type}}');
  }
}
