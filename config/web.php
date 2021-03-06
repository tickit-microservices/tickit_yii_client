<?php

use app\entities\models\User;

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';
$providers = require __DIR__ . '/providers.php';

$config = [
    'id' => 'tickit_project',
    'basePath' => dirname(__DIR__),
    'bootstrap' => array_merge(['log'], $providers),
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '8zDoMaDzRr4HYvZrc2rbcVcT4qe7F6XI',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => User::class,
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'GET signup' => 'user/sign-up-form',
                'POST signup' => 'user/sign-up',
                'GET login' => 'session/login-form',
                'POST login' => 'session/login',
                'GET projects' => 'project/index',
                'GET projects/<id:\d+>' => 'project/show',
                'POST projects/<id:\d+>/join' => 'project/join',
                'POST projects/<id:\d+>/ticks' => 'project/tick',
                'DELETE projects/<id:\d+>/ticks/<tickId:\d+>' => 'project/remove-tick'
            ],
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
