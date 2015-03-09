<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\PaymentsType */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => Yii::t('app', 'Payment Type'),
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Payments Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="payments-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
