<?php

use yii\db\Schema;
use yii\db\Migration;

class m150111_181611_add_objects_table extends Migration
{
  public function up()
  {
    $tableOptions = null;
    if ($this->db->driverName === 'mysql') {
      // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
      $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
    }

    $this->createTable('{{%object_parts}}', [
      'id' => Schema::TYPE_PK,
      'name' => Schema::TYPE_STRING . ' NOT NULL COMMENT \'Object part name\'',

      'description' => Schema::TYPE_STRING . ' COMMENT \'Object part description\'',

      'status' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 10',
      'created_at' => Schema::TYPE_INTEGER,
      'updated_at' => Schema::TYPE_INTEGER,
    ], $tableOptions);

    $this->createTable('{{%objects}}', [
      'id' => Schema::TYPE_PK,

      'house_id' => Schema::TYPE_INTEGER . ' NOT NULL COMMENT \'Object house ID\'',
      'part_type_id' => Schema::TYPE_INTEGER . ' NOT NULL COMMENT \'Object part type ID\'',
      'part_description' => Schema::TYPE_STRING . ' COMMENT \'Object part description\'',


      'status' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 10',
      'created_at' => Schema::TYPE_INTEGER,
      'updated_at' => Schema::TYPE_INTEGER,
    ], $tableOptions);

    $this->addForeignKey('FK_object_address', 'objects', 'house_id', 'houses', 'id', 'CASCADE', 'NO ACTION');
    $this->addForeignKey('FK_object_part_type', 'objects', 'part_type_id', 'object_parts', 'id', 'CASCADE', 'NO ACTION');
  }

  public function down()
  {
    $this->dropTable('{{%objects}}');
    $this->dropTable('{{%object_parts}}');
  }
}
