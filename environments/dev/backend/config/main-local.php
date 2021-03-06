<?php

$config = [
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'K19pq2xMDZsxOodzgK4G',
            'baseUrl' => '/backend',
        ],
        'urlManager' => [
            'baseUrl' => '/backend',
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],
    ],
];

//if (!YII_ENV_TEST) {
//    // configuration adjustments for 'dev' environment
//    $config['bootstrap'][] = 'debug';
//    $config['modules']['debug'] = 'yii\debug\Module';
//
//    $config['bootstrap'][] = 'gii';
//    $config['modules']['gii']['class'] = 'yii\gii\Module';
//    $config['modules']['gii']['allowedIPs'] = ['*'];
//}

return $config;
