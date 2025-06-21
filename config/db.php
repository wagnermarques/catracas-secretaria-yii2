<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => $_ENV['PDO_DSN'], 
    'username' => $_ENV['DB_USER'],
    'password' => $_ENV['DB_PASS'],
    'charset' => 'utf8',

    #
    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
