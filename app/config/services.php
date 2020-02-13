<?php
/**
 * Services are globally registered in this file
 *
 * @var \Phalcon\Config $config
 */


use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\Model\Manager as ModelsManager;

$di = new FactoryDefault();

/**
 * Models manager
 */
$di->set('modelsManager', function () {
    $modelsManager = new ModelsManager();
    return $modelsManager;
});

/**
 * Database connection is created based in the parameters defined in the configuration file
 */
$di->setShared('db', function () use ($config) {
    $dbConfig = $config->database->toArray();
    $adapter = $dbConfig['adapter'];
    unset($dbConfig['adapter']);
    $class = 'Phalcon\Db\Adapter\Pdo\\' . $adapter;
    $connection = new $class($dbConfig);
    $connection->setNestedTransactionsWithSavepoints(true);

    return $connection;
});

/**
 * Another Database connection is created based in the parameters defined in the configuration file
 */
$di->setShared('db_log', function () use ($config) {
    $dbConfig = $config->log_database->toArray();
    $adapter = $dbConfig['adapter'];
    unset($dbConfig['adapter']);

    $class = 'Phalcon\Db\Adapter\Pdo\\' . $adapter;

    $connection = new $class($dbConfig);
    $connection->setNestedTransactionsWithSavepoints(true);

    return $connection;
});

/**
 * tokenConfig
 */
$di->setShared('dbParams', function () use ($config) {
    return $config->database->toArray();
});
