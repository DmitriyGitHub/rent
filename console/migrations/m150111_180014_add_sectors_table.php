<?php

use yii\db\Schema;
use yii\db\Migration;

class m150111_180014_add_sectors_table extends Migration
{
  public function up()
  {
    $tableOptions = null;
    if ($this->db->driverName === 'mysql') {
      // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
      $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
    }

    $this->createTable('{{%areas}}', [
      'id' => Schema::TYPE_PK,
      'short_name' => Schema::TYPE_STRING . ' NOT NULL COMMENT \'Area short name\'',
      'full_name' => Schema::TYPE_STRING . ' NOT NULL COMMENT \'Area full name\'',

      'status' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 10',
      'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
      'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
    ], $tableOptions);


    $this->createTable('{{%districts}}', [
      'id' => Schema::TYPE_PK,
      'name' => Schema::TYPE_STRING . ' NOT NULL COMMENT \'District name\'',

      'type' => Schema::TYPE_SMALLINT . ' NOT NULL COMMENT \'District type\'',

      'area' => Schema::TYPE_INTEGER . ' NOT NULL COMMENT \'District area ID\'',

      'status' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 10',
      'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
      'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
    ], $tableOptions);

    $this->createTable('{{%sectors}}', [
      'id' => Schema::TYPE_PK,
      'name' => Schema::TYPE_STRING . ' NOT NULL COMMENT \'Sector name\'',
      'description' => Schema::TYPE_STRING . ' NOT NULL COMMENT \'Sector description\'',

      'sector_district' => Schema::TYPE_INTEGER . ' NOT NULL COMMENT \'Sector district ID\'',

      'status' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 10',
      'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
      'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
    ], $tableOptions);

    $this->addForeignKey('FK_sector_district', 'sectors', 'sector_district', 'districts', 'id', 'CASCADE', 'NO ACTION');
    $this->addForeignKey('FK_district_area', 'districts', 'area', 'areas', 'id', 'CASCADE', 'NO ACTION');
  }

  public function down()
  {
    $this->dropTable('{{%sectors}}');
    $this->dropTable('{{%districts}}');
    $this->dropTable('{{%areas}}');
  }
}
