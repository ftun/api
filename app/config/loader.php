<?php

/**
 * Registering an autoloader
 */
$loader = new \Phalcon\Loader();

$loader->registerNamespaces(
    [
        // "Api\\Helper" => realpath(__DIR__ . "/../helpers/"),
        // "Api\\Behaviors" => realpath(__DIR__ . "/../behaviors/"),
        // "Api\\components" => realpath(__DIR__ . "/../components"),
        'Api\\controllers' => realpath(__DIR__ . '/../controllers/'),
        // 'Api\\middlewares' => realpath(__DIR__ . '/../middlewares/'),
        'Api\\models' => realpath(__DIR__ . '/../models/'),
    ]
);

$loader->register();
