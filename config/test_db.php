<?php
// test database! Important not to run tests on production or development databases
$db = require __DIR__ . '/db.php';
$db['dsn'] = 'mysql:host=eteczlcatracas-mysql;dbname=eteczlcatracas_db_test';

return $db;