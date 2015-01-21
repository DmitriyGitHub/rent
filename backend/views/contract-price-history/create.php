<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ContractPriceHistory */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Contract Price History',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Contract Price Histories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contract-price-history-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
