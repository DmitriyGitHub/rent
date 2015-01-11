<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\StreetsTypes */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Streets Types',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Streets Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="streets-types-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
