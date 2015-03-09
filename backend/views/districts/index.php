<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use common\models\Areas;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\DistrictsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Districts');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="districts-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create {modelClass}', [
    'modelClass' => Yii::t('app', 'District'),
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'name',
            'description',
            [
                'attribute' => 'area_id',
                'label' => Yii::t('app', 'Area'),
                'value' => function($model){
                    return $model->area->full_name;
                },
                'filter' => Arrayhelper::map(Areas::find()->all(), 'id', 'full_name'),
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
                'buttons' => [
                    'delete' => function ($url, $model, $key) {
                        if(count($model->sectors)){
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
