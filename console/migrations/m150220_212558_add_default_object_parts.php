<?php

use yii\db\Schema;
use yii\db\Migration;
use common\models\ObjectParts;

class m150220_212558_add_default_object_parts extends Migration
{
    public function up()
    {
        $part = new ObjectParts();
        $part->id = 1;
        $part->name = Yii::t('app', 'Basement');
        $part->save();
        
        $part = new ObjectParts();
        $part->id = 2;
        $part->name = Yii::t('app', 'Attic');
        $part->save();
        
        $part = new ObjectParts();
        $part->id = 3;
        $part->name = Yii::t('app', 'Flat');
        $part->save();
        
        $part = new ObjectParts();
        $part->id = 4;
        $part->name = Yii::t('app', 'Premises');
        $part->save();
    }

    public function down()
    {
        ObjectParts::deleteAll(['in', 'id', [1,2,3,4]]);
    }
}
