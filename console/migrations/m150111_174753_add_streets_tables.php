<?php

use yii\db\Schema;
use yii\db\Migration;

class m150111_174753_add_streets_tables extends Migration
{
  public function up()
  {
    $tableOptions = null;
    if ($this->db->driverName === 'mysql') {
      // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
      $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
    }

    $this->createTable('{{%streets_types}}', [
      'id' => Schema::TYPE_PK,
      'short_name' => Schema::TYPE_STRING . ' NOT NULL COMMENT \'Street type short name\'',
      'full_name' => Schema::TYPE_STRING . ' NOT NULL COMMENT \'Street type full name\'',

      'status' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 10',
      'created_at' => Schema::TYPE_INTEGER,
      'updated_at' => Schema::TYPE_INTEGER,
    ], $tableOptions);


    $this->createTable('{{%streets}}', [
      'id' => Schema::TYPE_PK,
      'name' => Schema::TYPE_STRING . ' NOT NULL COMMENT \'Street name\'',

      'street_type' => Schema::TYPE_INTEGER . ' NOT NULL COMMENT \'Street type ID\'',

      'status' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 10',
      'created_at' => Schema::TYPE_INTEGER,
      'updated_at' => Schema::TYPE_INTEGER,
    ], $tableOptions);

    $this->addForeignKey('FK_street_type', 'streets', 'street_type', 'streets_types', 'id', 'CASCADE', 'NO ACTION');
  }

  public function down()
  {
    $this->dropTable('{{%streets}}');
    $this->dropTable('{{%streets_types}}');
  }
}
