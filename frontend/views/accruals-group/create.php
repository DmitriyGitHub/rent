<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\AccrualsGroup */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Accruals Group',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Accruals Groups'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="accruals-group-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
