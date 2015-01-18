<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\OrganisationsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="organisations-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'okpo') ?>

    <?= $form->field($model, 'legal_address') ?>

    <?= $form->field($model, 'real_address') ?>

    <?= $form->field($model, 'budget_org') ?>

    <?php // echo $form->field($model, 'general_org') ?>

    <?php // echo $form->field($model, 'vat_payer') ?>

    <?php // echo $form->field($model, 'self_org') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
