<?php

use yii\db\Schema;
use yii\db\Migration;
use common\models\StreetsTypes;

class m150220_211832_add_default_street_types extends Migration
{
    public function up()
    {
        $street = new StreetsTypes();
        $street->id = 1;
        $street->short_name = Yii::t('app', 'st.');
        $street->full_name = Yii::t('app', 'street');
        $street->save();
        
        $street = new StreetsTypes();
        $street->id = 2;
        $street->short_name = Yii::t('app', 'blvd.');
        $street->full_name = Yii::t('app', 'boulevard');
        $street->save();
        
        $street = new StreetsTypes();
        $street->id = 3;
        $street->short_name = Yii::t('app', 'ave.');
        $street->full_name = Yii::t('app', 'avenue');
        $street->save();
        
        $street = new StreetsTypes();
        $street->id = 4;
        $street->short_name = Yii::t('app', 'lan.');
        $street->full_name = Yii::t('app', 'lane');
        $street->save();
    }

    public function down()
    {
        StreetsTypes::deleteAll(['in', 'id', [1,2,3,4]]);
    }
}
