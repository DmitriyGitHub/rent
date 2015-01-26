<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\ServicesType;
use yii\helpers\ArrayHelper;
use common\models\PaymentsType;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PaymentsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Payments');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="payments-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Payments',
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'number',
            'date',
            'amount',
            [
                'attribute' => 'contract_number',
                'value' => 'contract.number',
            ],
            [
                'attribute' => 'type_id',
                'value' => 'type.name',
                'filter' => ArrayHelper::map(PaymentsType::find()->all(), 'id', 'name'),
            ],
            [
                'attribute' => 'service_id',
                'value' => 'service.name',
                'filter' => ArrayHelper::map(ServicesType::find()->all(), 'id', 'name'),
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
