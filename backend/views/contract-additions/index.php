<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ContractAdditionsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Contract Additions');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contract-additions-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Contract Additions',
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'date',
            [
                'attribute' => 'contract_number',
                'value' => 'contract.number',
            ],
            'number',
            'description',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {prices}',
                'buttons' => [
                    'prices' => function ($url, $model, $key) {
                        $url = ['/contract-price-history/index', 'ContractPriceHistorySearch' => ['contract_addition_id' => $model->id]];
                        return Html::a('<span class="glyphicon glyphicon-folder-open"></span>', $url, [
                            'title' => Yii::t('yii', 'Prices'),
                            'data-pjax' => '0',
                        ]);
                    }
                ],
            ],
        ],
    ]); ?>

</div>
