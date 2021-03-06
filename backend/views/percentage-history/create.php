<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\PercentageHistory */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Percentage History',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Percentage Histories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="percentage-history-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
