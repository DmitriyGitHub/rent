<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Organisations */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="organisations-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'okpo')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'legal_address')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'real_address')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'budget_org')->textInput() ?>

    <?= $form->field($model, 'general_org')->textInput() ?>

    <?= $form->field($model, 'vat_payer')->textInput() ?>

    <?= $form->field($model, 'self_org')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
