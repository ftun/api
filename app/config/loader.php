<?php

/**
 * Registering an autoloader
 */
$loader = new \Phalcon\Loader();

$loader->registerNamespaces(
    [
        "Api\\Helper" => realpath(__DIR__ . "/../helpers/"),
        'Api\\controllers' => realpath(__DIR__ . '/../controllers/'),
        'Api\\models' => realpath(__DIR__ . '/../models/'),
    ]
);

$loader->register();
