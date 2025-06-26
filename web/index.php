<?php

// Carrega o autoload do Composer, que gerencia as depend�ncias do projeto
require __DIR__ . '/../vendor/autoload.php';

// Cria uma inst�ncia do Dotenv para carregar as vari�veis de ambiente do arquivo .env
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');

//carrega as vari�veis
$dotenv->load();

//

// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', $_ENV['APP_DEBUG_MODE']);
defined('YII_ENV') or define('YII_ENV', $_ENV['APP_ENVIRONMENT']);

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

$config = require __DIR__ . '/../config/web.php';

(new yii\web\Application($config))->run();

#$doc = Yii::$app->guzzleClient->getDocument('catracaspassagens', '6lYLkhPSHFIgDKAsJr0c');

