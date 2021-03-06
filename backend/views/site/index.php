<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use common\models\Objects;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ContractsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Contracts');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contracts-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => '\kartik\grid\ExpandRowColumn',
                'value' => function ($model, $key, $index, $column) {
                    return GridView::ROW_COLLAPSED;
                },
                'detailUrl' => 'contract-data',
                'allowBatchToggle' => TRUE,
            ],
            [
                'attribute' => 'organisation_name',
                'value' => 'organisation.name',
                'label' => Yii::t('app', 'Organisation'),
            ],
            [
                'attribute' => 'number',
            ],
            [
                'attribute' => 'object_address',
                'value' => 'object.fullAddress',
                'label' => Yii::t('app', 'Address'),
            ],
            'latestAccrual',
            'latestPayment',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}',
            ],
        ],
        'toolbar'=>[
            '{export}',
            '{toggleData}'
        ]
    ]); ?>

</div>
