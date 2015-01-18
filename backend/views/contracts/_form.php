<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Organisations;
use common\models\Objects;
use common\models\ContractsType;
use kartik\money\MaskMoney;


/* @var $this yii\web\View */
/* @var $model common\models\Contracts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contracts-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'number')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'date')->widget(DatePicker::widget([
            'pluginOptions' => [
                'autoclose'=>true,
                'format' => 'dd-M-yyyy'
            ]
        ])) 
    ?>

    <?= $form->field($model, 'start_date')->textInput() ?>

    <?= $form->field($model, 'end_date')->textInput() ?>
    
    <?= 
        $form->field($model, 'object_id')
            ->dropDownList(
                ArrayHelper::map(Objects::find()->all(), 'id', 'fullAddress')
            ) 
    ?>
    
    <?= 
        $form->field($model, 'organisation_id')
            ->dropDownList(
                ArrayHelper::map(Organisations::find()->all(), 'id', 'name')
            ) 
    ?>

    <?= 
        $form->field($model, 'type_id')
            ->dropDownList(
                ArrayHelper::map(ContractsType::find()->all(), 'id', 'name')
            ) 
    ?>

    <?= $form->field($model, 'square')->textInput(['maxlength' => 15]) ?>

    <?= $form->field($model, 'descriptions')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'initial_price')->widget(MaskMoney::classname(), [
            'pluginOptions' => [
                'prefix' => html_entity_decode('&#8372; '),
                'suffix' => '',
                'allowNegative' => false
            ]
        ])
    ?>

    <?= $form->field($model, 'account_number')->textInput(['maxlength' => 255]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
