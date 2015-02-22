<?php
return [
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
