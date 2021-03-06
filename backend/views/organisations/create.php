<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Organisations */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => Yii::t('app', 'Organisation'),
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Organisations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="organisations-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
