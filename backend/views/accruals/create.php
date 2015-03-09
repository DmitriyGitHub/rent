<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Accruals */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => Yii::t('app', 'Accrual'),
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Accruals'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="accruals-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
