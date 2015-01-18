<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Houses;
use common\models\ObjectParts;

/* @var $this yii\web\View */
/* @var $model common\models\Objects */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="objects-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= 
        $form->field($model, 'house_id')
            ->dropDownList(
                ArrayHelper::map(Houses::find()->all(), 'id', 'fullAddress')
            ) 
    ?>

    <?= 
        $form->field($model, 'part_type_id')
            ->dropDownList(
                ArrayHelper::map(ObjectParts::find()->all(), 'id', 'name')
            ) 
    ?>

    <?= $form->field($model, 'part_description')->textInput(['maxlength' => 255]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
