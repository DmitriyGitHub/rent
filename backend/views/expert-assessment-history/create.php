<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ExpertAssessmentHistory */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Expert Assessment History',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Expert Assessment Histories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="expert-assessment-history-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
