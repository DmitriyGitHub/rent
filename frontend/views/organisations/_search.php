<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\OrganisationsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="organisations-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'okpo') ?>

    <?= $form->field($model, 'legal_address') ?>

    <?= $form->field($model, 'real_address') ?>

    <?php // echo $form->field($model, 'budget_org') ?>

    <?php // echo $form->field($model, 'general_org') ?>

    <?php // echo $form->field($model, 'vat_payer') ?>

    <?php // echo $form->field($model, 'self_org') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
