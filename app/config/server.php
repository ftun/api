<?php

/**
* @property integer. Id del sistema
*/
const SISTEMA = 8;

/**
* @property array. Parametros de configuracion para el servidor de Api REST
*/
return [
    'database' => [
        'adapter' => 'Mysql',
        'host' => 'localhost',
        'username' => 'root',
        'password' => 'root',
        'dbname' => 'bds_test',
        'charset' => 'utf8',
    ]
];
