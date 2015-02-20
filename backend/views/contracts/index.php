<?php

use yii\helpers\Html;
use yii\grid\GridView;
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
            ['class' => 'yii\grid\SerialColumn'],

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
            'expertAssessmentSquare',
            'descriptions',
            'expertAssessmentAmount',
            'account_number',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {additions}',
                'buttons' => [
                    'additions' => function ($url, $model, $key) {
                        $url = ['/contract-additions/index', 'ContractAdditionsSearch' => ['contract_number' => $model->number]];
                        return Html::a('<span class="glyphicon glyphicon-folder-open"></span>', $url, [
                            'title' => Yii::t('yii', 'Additions'),
                            'data-pjax' => '0',
                        ]);
                    }
                ],
            ],
        ],
    ]); ?>

</div>
