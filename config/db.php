<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => $_ENV['PDO_DSN'] ?? getenv('PDO_DSN'), 
    'username' => $_ENV['DB_USER'] ?? getenv('DB_USER'),
    'password' => $_ENV['DB_PASS'] ?? getenv('DB_PASS'),
    'charset' => 'utf8',

    #
    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
