<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ContractsType */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => Yii::t('app', 'Contract Type'),
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Contracts Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contracts-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
