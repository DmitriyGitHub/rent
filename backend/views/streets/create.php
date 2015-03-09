<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Streets */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => Yii::t('app', 'Street'),
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Streets'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="streets-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
