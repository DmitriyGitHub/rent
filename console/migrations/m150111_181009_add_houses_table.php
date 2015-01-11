<?php

use yii\db\Schema;
use yii\db\Migration;

class m150111_181009_add_houses_table extends Migration
{
  public function up()
  {
    $tableOptions = null;
    if ($this->db->driverName === 'mysql') {
      // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
      $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
    }

    $this->createTable('{{%houses}}', [
      'id' => Schema::TYPE_PK,
      'number' => Schema::TYPE_SMALLINT . ' NOT NULL COMMENT \'House number\'',
      'letter' => Schema::TYPE_STRING . ' COMMENT \'House letter\'',
      'part_type' => Schema::TYPE_SMALLINT . ' NOT NULL COMMENT \'House part type\'',
      'part' => Schema::TYPE_STRING . ' COMMENT \'House part description\'',

      'street' => Schema::TYPE_INTEGER . ' NOT NULL COMMENT \'House street ID\'',
      'sector' => Schema::TYPE_INTEGER . ' NOT NULL COMMENT \'House sector ID\'',

      'status' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 10',
      'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
      'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
    ], $tableOptions);

    $this->addForeignKey('FK_house_street', 'houses', 'street', 'streets', 'id', 'CASCADE', 'NO ACTION');
    $this->addForeignKey('FK_house_sector', 'houses', 'sector', 'sectors', 'id', 'CASCADE', 'NO ACTION');

  }

  public function down()
  {
    $this->dropTable('{{%houses}}');
  }
}
