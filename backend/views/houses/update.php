<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Houses */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => Yii::t('app', 'House'),
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Houses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="houses-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
