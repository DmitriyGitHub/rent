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

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Contracts',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Contracts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contracts-create">

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
    
    <?= $form->field($model, 'account_number')->textInput(['maxlength' => 255]) ?>
    
    <?= $form->field($model, 'descriptions')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'expertAssessmentSquare')->textInput(['maxlength' => 15]) ?>

    <?= $form->field($model, 'expertAssessmentAmount')->widget(MaskMoney::classname(), [
            'pluginOptions' => [
                'prefix' => html_entity_decode('&#8372; '),
                'suffix' => '',
                'allowNegative' => false,
                'allowZero' => true,
            ]
        ])
    ?>
    
    <?= $form->field($model, 'price')->widget(MaskMoney::classname(), [
            'pluginOptions' => [
                'prefix' => html_entity_decode('&#8372; '),
                'suffix' => '',
                'allowNegative' => false,
                'allowZero' => true,
            ]
        ])
    ?>
    
    <?= $form->field($model, 'percentage')->textInput(['maxlength' => 15]) ?>
    
    <?= $form->field($model, 'usePurpose')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Create'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
