<?php

use yii\db\Schema;
use yii\db\Migration;
use common\models\PaymentsType;

class m150121_213949_add_default_payment_types extends Migration
{
    public function up()
    {
        $rent = new PaymentsType();
        $rent->id = 1;
        $rent->name = Yii::t('app', 'Rent');
        $rent->description = $rent->name;
        $rent->save();
        
        $mutual = new PaymentsType();
        $mutual->id = 2;
        $mutual->name = Yii::t('app', 'Mutual');
        $mutual->description = $mutual->name;
        $mutual->save();
    }

    public function down()
    {
        PaymentsType::deleteAll(['in', 'id', [1,2]]);
    }
}
