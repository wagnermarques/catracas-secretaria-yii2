<?php

Yii::trace('===> web.php...');

use yii\i18n\Formatter;
use app\util\GuzzleClient;

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'name' => $_ENV['APP_NAME_IN_HOME_PAGE'],
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'language' => 'pt-BR', 
    'components' => [           
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'KS3I0HPmcOnJ0oiC4rXB-SVAMXMgTtgv',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => \yii\symfonymailer\Mailer::class,
            'viewPath' => '@app/mail',
            // send all mails to a file by default.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 0 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['trace'],
                    'logVars' => [], // Impede o log das superglobais
                    'logFile' => '@runtime/logs/trace_and_error.log',
                    'except' => ['yii\base*','yii\web\*'],
                    //'categories' => ['!=yii\base'], // Filter by category
                ],
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['info', 'error'],
                    'logVars' => [], // Impede o log das superglobais
                    'logFile' => '@runtime/logs/info_and_warnings.log'                    
                ],
            ],
        ],
        'formatter' => [
            'class' => 'yii\i18n\Formatter', //'class' => Formatter::class,
            'dateFormat' => 'dd/MM/yyyy',
            'timeFormat' => 'HH:mm:ss',
            'datetimeFormat' => 'dd/MM/yyyy HH:mm:ss',
            'decimalSeparator' => ',',
            'thousandSeparator' => '.',
            'currencyCode' => 'BRL',
        ],
    'db' => $db,
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
    'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/messages',
                    // 'sourceLanguage' => 'en-US', // Opcional, idioma original dos textos
                    'fileMap' => [
                        'app' => 'app.php',
                        'app/error' => 'error.php',
                    ],
                ],
                // Adicionar configuração para as mensagens do Gii
                'gii' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@vendor/yiisoft/yii2-gii/messages', // Caminho padrão das mensagens do Gii
                    'forceTranslation' => true, // Força a tradução mesmo se a mensagem for igual ao sourceLanguage
                    'fileMap' => [
                        'gii' => 'gii.php',
                    ],
                ],
                // Adicionar configuração para as mensagens do Yii (framework)
                'yii' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@vendor/yiisoft/yii2/messages', // Caminho padrão das mensagens do Yii
                    'forceTranslation' => true,
                    'fileMap' => [
                        'yii' => 'yii.php',
                    ],
                ],
            ],
        ],//i18n
    ], //components
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
