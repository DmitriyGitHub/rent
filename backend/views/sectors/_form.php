<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Districts;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Sectors */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sectors-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => 255]) ?>

    <?= 
        $form->field($model, 'district_id')
            ->dropDownList(
                ArrayHelper::map(Districts::find()->all(), 'id', 'name')
            ) 
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
