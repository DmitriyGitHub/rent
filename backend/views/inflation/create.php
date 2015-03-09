<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Inflation */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => Yii::t('app', 'Inflation'),
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Inflations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inflation-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
