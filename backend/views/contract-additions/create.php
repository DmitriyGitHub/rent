<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ContractAdditions */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Contract Additions',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Contract Additions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contract-additions-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
