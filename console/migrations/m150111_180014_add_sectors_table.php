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
      'created_at' => Schema::TYPE_INTEGER,
      'updated_at' => Schema::TYPE_INTEGER,
    ], $tableOptions);


    $this->createTable('{{%districts}}', [
      'id' => Schema::TYPE_PK,
      'name' => Schema::TYPE_STRING . ' NOT NULL COMMENT \'District name\'',

      'description' => Schema::TYPE_SMALLINT . ' COMMENT \'District description\'',

      'area_id' => Schema::TYPE_INTEGER . ' NOT NULL COMMENT \'District area ID\'',

      'status' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 10',
      'created_at' => Schema::TYPE_INTEGER,
      'updated_at' => Schema::TYPE_INTEGER,
    ], $tableOptions);

    $this->createTable('{{%sectors}}', [
      'id' => Schema::TYPE_PK,
      'name' => Schema::TYPE_STRING . ' NOT NULL COMMENT \'Sector name\'',
      'description' => Schema::TYPE_STRING . ' COMMENT \'Sector description\'',

      'district_id' => Schema::TYPE_INTEGER . ' NOT NULL COMMENT \'Sector district ID\'',

      'status' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 10',
      'created_at' => Schema::TYPE_INTEGER,
      'updated_at' => Schema::TYPE_INTEGER,
    ], $tableOptions);

    $this->addForeignKey('FK_sector_district', 'sectors', 'district_id', 'districts', 'id', 'CASCADE', 'NO ACTION');
    $this->addForeignKey('FK_district_area', 'districts', 'area_id', 'areas', 'id', 'CASCADE', 'NO ACTION');
  }

  public function down()
  {
    $this->dropTable('{{%sectors}}');
    $this->dropTable('{{%districts}}');
    $this->dropTable('{{%areas}}');
  }
}
