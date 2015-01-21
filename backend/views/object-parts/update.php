<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ObjectParts */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Object Parts',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Object Parts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="object-parts-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
