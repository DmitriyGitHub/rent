<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Contracts */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Contracts',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Contracts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contracts-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
