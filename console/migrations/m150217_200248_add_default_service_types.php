<?php

use yii\db\Schema;
use yii\db\Migration;
use common\models\ServicesType;

class m150217_200248_add_default_service_types extends Migration
{
    public function up()
    {
        $rent = new ServicesType();
        $rent->id = 1;
        $rent->name = Yii::t('app', 'Rent');
        $rent->description = $rent->name;
        $rent->save();
        
        $mutual = new ServicesType();
        $mutual->id = 2;
        $mutual->name = Yii::t('app', 'Mutual');
        $mutual->description = $mutual->name;
        $mutual->save();
    }

    public function down()
    {
        ServicesType::deleteAll(['in', 'id', [1,2]]);
    }
}
