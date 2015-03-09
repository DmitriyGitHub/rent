<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use common\models\StreetsTypes;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\StreetsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Streets');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="streets-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create {modelClass}', [
    'modelClass' => Yii::t('app', 'Street'),
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'street_type_id',
                'value' => 'streetType.full_name',
                'filter' => ArrayHelper::map(StreetsTypes::find()->all(), 'id', 'full_name'),
            ],
            'name',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
                'buttons' => [
                    'delete' => function ($url, $model, $key) {
                        if(count($model->houses)){
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
