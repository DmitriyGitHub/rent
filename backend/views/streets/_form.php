<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\StreetsTypes;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Streets */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="streets-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= 
        $form->field($model, 'street_type')
            ->dropDownList(
                ArrayHelper::map(StreetsTypes::find()->all(), 'id', 'full_name')
            ) 
    ?>
    
    <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
