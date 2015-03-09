<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\StreetsTypes */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => Yii::t('app', 'Street Type'),
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Streets Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="streets-types-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
