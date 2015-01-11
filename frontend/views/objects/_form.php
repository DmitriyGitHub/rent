<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\ObjectParts;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Objects */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="objects-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'address')->textInput() ?>

    <?= $form->field($model, 'part_type')->dropDownList(
      ArrayHelper::map(ObjectParts::find()->all(), 'id', 'name')
    ) ?>

    <?= $form->field($model, 'part_description')->textInput(['maxlength' => 255]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
