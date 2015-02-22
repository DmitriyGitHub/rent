<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Organisations;
use common\models\Objects;
use common\models\ContractsType;
use kartik\money\MaskMoney;
use kartik\widgets\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\Contracts */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Contracts',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Contracts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="contracts-update">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'number')->textInput(['maxlength' => 255]) ?>

    <?= 
        $form->field($model, 'date')->widget(
            DatePicker::classname(), 
            [
//                'options' => ['placeholder' => 'Enter birth date ...'],
                'pluginOptions' => [
                    'autoclose'=>true,
                    'format' => 'yyyy-mm-dd',
                ]
            ]
        )
    ?>

    <?= 
        $form->field($model, 'start_date')->widget(
            DatePicker::classname(), 
            [
//                'options' => ['placeholder' => 'Enter birth date ...'],
                'pluginOptions' => [
                    'autoclose'=>true,
                    'format' => 'yyyy-mm-dd',
                ]
            ]
        )
    ?>

        <?= 
        $form->field($model, 'end_date')->widget(
            DatePicker::classname(), 
            [
//                'options' => ['placeholder' => 'Enter birth date ...'],
                'pluginOptions' => [
                    'autoclose'=>true,
                    'format' => 'yyyy-mm-dd',
                ]
            ]
        )
    ?>
    
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

    <?= $form->field($model, 'descriptions')->textInput(['maxlength' => 255]) ?>
    
    <?= $form->field($model, 'account_number')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'expertAssessmentSquare')->textInput(['readonly' => TRUE]) ?>
    
    <?= $form->field($model, 'expertAssessmentAmount')->textInput(['readonly' => TRUE]) ?>
        
    <?= $form->field($model, 'price')->textInput(['readonly' => TRUE]) ?>
    
    <?= $form->field($model, 'percentage')->textInput(['readonly' => TRUE]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    
    <?= 
        $this->render(
            '/site/_contract-additions', 
            [
                'contractAdditions' => $contractAdditions,
            ]
        );
    ?>

</div>
