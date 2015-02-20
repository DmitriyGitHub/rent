<?php

use yii\db\Schema;
use yii\db\Migration;
use common\models\PaymentsType;

class m150220_210922_add_default_payment_types extends Migration
{
    public function up()
    {
        $cashless = new PaymentsType();
        $cashless->id = 1;
        $cashless->name = Yii::t('app', 'Cashless');
        $cashless->description = $cashless->name;
        $cashless->save();
        
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
