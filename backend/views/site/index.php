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
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Contracts',
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => '\kartik\grid\ExpandRowColumn',
                'value' => function ($model, $key, $index, $column) {
                    return GridView::ROW_COLLAPSED;
                },
                'detailUrl' => 'site/contract-data',
                'allowBatchToggle' => FALSE,
            ],

            'number',
            'date:date',
            'start_date:date',
            'end_date:date',
            [
                'attribute' => 'object_address',
                'value' => 'object.fullAddress',
            ],
            [
                'attribute' => 'organisation_name',
                'value' => 'organisation.name',
            ],
            [
                'attribute' => 'type_name',
                'value' => 'type.name',
            ],
            'square',
            'descriptions',
            'initial_price',
            'account_number',

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
