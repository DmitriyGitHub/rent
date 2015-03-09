<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use common\models\ServicesType;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AccrualsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Accruals');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="accruals-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create {modelClass}', [
    'modelClass' => Yii::t('app', 'Accrual'),
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'date',
            'amount',
            [
                'attribute' => 'contract_number',
                'value' => 'contract.number',
                'label' => Yii::t('app', 'Contract number'),
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
