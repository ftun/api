<?php


use Phalcon\Mvc\Micro\Collection as MicroCollection;


// $generator = new MicroCollection();
// $generator->setHandler('Api\controllers\GeneratorcodeController', true);
// $generator->setPrefix('/generator');
// $generator->get('/', 'index');
// $generator->get('/code/{tbl:[a-zA-Z0-9\-\w]+}', 'getCode');
// $app->mount($generator);

$index = new MicroCollection();
$index->setHandler('Api\controllers\IndexController', true);
$index->get('/', 'index');
$app->mount($index);

/**
 * Not found handler
 */
$app->notFound(function () use ($app) {
    $app->response->setStatusCode(404, "Not Found")->sendHeaders();
    $app->response->setContentType('application/json', 'UTF-8');
    $app->response->setJsonContent(array(
        "status" => "error",
        "code" => "404",
        "messages" => "URL Not found",
    ));
    $app->response->send();
});

/**
 * Error handler
 */
$app->error(
    function ($exception) {
        echo "An error has occurred";
    }
);
