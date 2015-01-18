<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\HousesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Houses');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="houses-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Houses',
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'street.name' => [
                'attribute' => 'street.name',
                'value' => function($model){
                    return $model->street->streetType->short_name . ' ' . $model->street->name;
                },
            ],
            'number',
            'letter',
            'partDescription',
            'sectorPath',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
