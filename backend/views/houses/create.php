<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Houses */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => Yii::t('app', 'House'),
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Houses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="houses-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
