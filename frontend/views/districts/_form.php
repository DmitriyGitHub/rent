<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Areas;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Districts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="districts-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'type')->textInput() ?>

    <?= $form->field($model, 'area')->dropDownList(
      ArrayHelper::map(Areas::find()->all(), 'id', 'short_name')
    ) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
