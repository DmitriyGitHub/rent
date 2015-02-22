<?php
use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>
    <div class="wrap">
        <?php
            NavBar::begin([
                'brandLabel' => Yii::t('app', 'Rent'),
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            $menuItems = [
                ['label' => Yii::t('yii', 'Home'), 'url' => ['/site/index']],
            ];
            if (Yii::$app->user->isGuest) {
                $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
            } else if(\common\models\User::hasBackendAccess()) {    
                $menuItems[] = ['label' => Yii::t('app', 'Organisations'), 'url' => ['/organisations']];
                $menuItems[] = ['label' => Yii::t('app', 'Payments'),
                    'items' => [
                        ['label' => Yii::t('app', 'Contracts'), 'url' => ['/contracts']],
                        ['label' => Yii::t('app', 'Accruals'), 'url' => ['/accruals']],
                        ['label' => Yii::t('app', 'Payments'), 'url' => ['/payments']],
                        ['label' => Yii::t('app', 'Inflations'), 'url' => ['/inflation']],
                    ]
                ];
                $menuItems[] = ['label' => Yii::t('app', 'Objects'),
                    'items' => [
                        ['label' => Yii::t('app', 'Streets'), 'url' => ['/streets']],
                        ['label' => Yii::t('app', 'Areas'), 'url' => ['/areas']],
                        ['label' => Yii::t('app', 'Districts'), 'url' => ['/districts']],
                        ['label' => Yii::t('app', 'Sectors'), 'url' => ['/sectors']],
                        ['label' => Yii::t('app', 'Houses'), 'url' => ['/houses']],
                        ['label' => Yii::t('app', 'Objects'), 'url' => ['/objects']],
                    ]
                ];
                $menuItems[] = ['label' => Yii::t('app', 'Vocabularies'),
                    'items' => [
                        ['label' => Yii::t('app', 'Service types'), 'url' => ['/services-type']],
                        ['label' => Yii::t('app', 'Payment types'), 'url' => ['/payments-type']],
                        ['label' => Yii::t('app', 'Contract types'), 'url' => ['/contracts-type']],
                        ['label' => Yii::t('app', 'Street types'), 'url' => ['/streets-types']],
                        ['label' => Yii::t('app', 'Object parts'), 'url' => ['/object-parts']],
                    ]
                ];
                
                $menuItems[] = [
                    'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ];
            }
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $menuItems,
            ]);
            NavBar::end();
        ?>

        <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
        <p class="pull-left">&copy; <?= Yii::t('app', 'Rent') . ' ' . date('Y') ?></p>
        <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
