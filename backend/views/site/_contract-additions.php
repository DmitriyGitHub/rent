<?php 
use yii\grid\GridView;
?>

<h4><?= Yii::t('app', 'Contract Additions') ?></h4>
<?= GridView::widget([
    'dataProvider' => $contractAdditions,
    'columns' => [
        'date',
        'number',
        'contractPriceHistory.amount',
        'expertAssessmentHistory.amount',
        'expertAssessmentHistory.square',
        'percentageHistory.amount',
    ],
]); ?>