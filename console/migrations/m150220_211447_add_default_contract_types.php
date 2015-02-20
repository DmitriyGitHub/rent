<?php

use yii\db\Schema;
use yii\db\Migration;
use common\models\ContractsType;

class m150220_211447_add_default_contract_types extends Migration
{
    public function up()
    {
        $rent = new ContractsType();
        $rent->id = 1;
        $rent->name = Yii::t('app', 'Rent');
        $rent->code = $rent->name[0];
        $rent->description = $rent->name;
        $rent->save();
        
        $self = new ContractsType();
        $self->id = 2;
        $self->name = Yii::t('app', 'Self');
        $self->code = $self->name[0];
        $self->description = $self->name;
        $self->save();
        
        $budget = new ContractsType();
        $budget->id = 3;
        $budget->name = Yii::t('app', 'Budget');
        $budget->code = $budget->name[0];
        $budget->description = $budget->name;
        $budget->save();
    }

    public function down()
    {
        ContractsType::deleteAll(['in', 'id', [1,2,3]]);
    }
}
