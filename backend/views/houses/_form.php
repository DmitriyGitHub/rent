<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Streets;
use common\models\Sectors;
use common\models\Houses;

/* @var $this yii\web\View */
/* @var $model common\models\Houses */
/* @var $form yii\widgets\ActiveForm */
$part_id = Html::getInputId($model, 'part');
$part_type_id = Html::getInputId($model, 'part_type');
$part_type_full = Houses::PART_TYPE_FULL;
$this->registerJs(<<<JSCODE
    addConditionalVisibility(
        '#$part_id', 
        '#$part_type_id', 
        {
            conditionCheckValue: ['$part_type_full', $part_type_full]
        }
    );
JSCODE
);
?>

<div class="houses-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= 
        $form->field($model, 'sector_id')
            ->dropDownList(
                ArrayHelper::map(Sectors::find()->all(), 'id', 'name')
            ) 
    ?>
    
    <?= 
        $form->field($model, 'street_id')
            ->dropDownList(
                ArrayHelper::map(Streets::find()->all(), 'id', 'name')
            ) 
    ?>

    <?= $form->field($model, 'number')->textInput() ?>

    <?= $form->field($model, 'letter')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'part_type')->dropDownList($model->partTypesList) ?>

    <?= $form->field($model, 'part')->textInput(['maxlength' => 255]) ?>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
