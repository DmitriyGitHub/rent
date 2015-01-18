<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\HousesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="houses-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'number') ?>

    <?= $form->field($model, 'letter') ?>

    <?= $form->field($model, 'part_type') ?>

    <?= $form->field($model, 'part') ?>

    <?= $form->field($model, 'street_id') ?>

    <?php // echo $form->field($model, 'sector_id') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
