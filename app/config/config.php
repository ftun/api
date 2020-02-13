<?php

use Phalcon\Config;

/**
* @property array. Configuraciondes del sistema
* Modified: prepend directory path of current file, because of this file own different ENV under between Apache and command line.
* NOTE: please remove this comment.
*/
$config = [
    'application' => [
        'title' => 'API',
        'description' => 'API Test',
        // 'libraryDir' => APP_PATH . '/library/',
        // 'middlewaresDir' => APP_PATH . '/middlewares/',
        'baseUri' => '/',
        'controllersDir' => "app/controllers/",
        'modelsDir' => "app/models/",
        // 'helpersDir' => APP_PATH . '/helpers/',
        // 'behaviorsDir' => APP_PATH . '/behaviors/',
        'baseUri' => preg_replace('/public([\/\\\\])index.php$/', '', $_SERVER["PHP_SELF"]),
    ],
];

$server = include_once __DIR__ . "/../config/server.php";
$config = array_merge($config, $server);
return new \Phalcon\Config($config);
