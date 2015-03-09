<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use common\models\Streets;
use common\models\Houses;
use common\models\Sectors;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\HousesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Houses');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="houses-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create {modelClass}', [
    'modelClass' => Yii::t('app', 'House'),
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'streetName',
                'value' => function($model){
                    return $model->street->streetType->short_name . ' ' . $model->street->name;
                },
                'label' => Yii::t('app', 'Street name'),
            ],
            'number',
            'letter',
            [
                'attribute' => 'part_type',
                'value' => 'partDescription',
                'filter' => Houses::getPartTypesList(),
            ],
            [
                'attribute' => 'sector_id',
                'value' => 'sectorPath',
                'filter' => ArrayHelper::map(Sectors::find()->all(), 'id', 'name'),
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
                'buttons' => [
                    'delete' => function ($url, $model, $key) {
                        if(count($model->objects)){
                            return '';
                        }
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                            'title' => Yii::t('yii', 'Delete'),
                            'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                            'data-method' => 'post',
                            'data-pjax' => '0',
                        ]);
                    }
                ],
            ],
        ],
    ]); ?>

</div>
