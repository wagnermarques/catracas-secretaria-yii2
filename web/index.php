<?php

// Carrega o autoload do Composer, que gerencia as dependências do projeto
require __DIR__ . '/../vendor/autoload.php';

// Cria uma instância do Dotenv para carregar as variáveis de ambiente do arquivo .env
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');

//carrega as variáveis
$dotenv->load();

//

// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', $_ENV['APP_DEBUG_MODE']);
defined('YII_ENV') or define('YII_ENV', $_ENV['APP_ENVIRONMENT']);

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

$config = require __DIR__ . '/../config/web.php';

(new yii\web\Application($config))->run();

$key = Yii::$app->guzzleClient->signInWithConfiguredFirebaseAuthEmailAndPassword();
var_dump($key);exit();

#$doc = Yii::$app->guzzleClient->getDocument('catracaspassagens', '6lYLkhPSHFIgDKAsJr0c');

