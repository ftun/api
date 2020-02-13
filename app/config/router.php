<?php


use Phalcon\Mvc\Micro\Collection as MicroCollection;

$index = new MicroCollection();
$index->setHandler('Api\controllers\IndexController', true);
$index->get('/index', 'index');
$app->mount($index);

$generator = new MicroCollection();
$generator->setHandler('Api\controllers\GeneratorcodeController', true);
$generator->setPrefix('/generator');
$generator->get('/', 'index');
$generator->get('/code/{tbl:[a-zA-Z0-9\-\w]+}', 'getCode');
$app->mount($generator);

$micro = new MicroCollection();
$micro->setHandler('Api\controllers\ActividadController', true);
$micro->setPrefix('/actividad');
$micro->get('/', 'index');
$micro->get('/search', 'search');
$micro->get('/byId/{id:[0-9]+}', 'getElementById');
$micro->post('/post', 'post');
$micro->put('/put/{id:[0-9]+}', 'put');
$app->mount($micro);

$micro = new MicroCollection();
$micro->setHandler('Api\controllers\CategoriaController', true);
$micro->setPrefix('/categoria');
$micro->get('/', 'index');
$micro->get('/search', 'search');
$micro->get('/porUnidad/{unidad:[0-9]+}', 'getCategoriasPorUnidad');
$micro->get('/byId/{id:[0-9]+}', 'getElementById');
$micro->post('/post', 'post');
$micro->put('/put/{id:[0-9]+}', 'put');
$app->mount($micro);

$micro = new MicroCollection();
$micro->setHandler('Api\controllers\HorarioController', true);
$micro->setPrefix('/horario');
$micro->get('/', 'index');
$micro->get('/search', 'search');
$micro->get('/byId/{id:[0-9]+}', 'getElementById');
$micro->post('/post', 'post');
$micro->put('/put/{id:[0-9]+}', 'put');
$app->mount($micro);

$micro = new MicroCollection();
$micro->setHandler('Api\controllers\PaquetecategoriaController', true);
$micro->setPrefix('/paqueteCategoria');
$micro->get('/', 'index');
$micro->get('/search', 'search');
$micro->get('/byId/{id:[0-9]+}', 'getElementById');
$micro->post('/post', 'post');
$micro->put('/put/{id:[0-9]+}', 'put');
$app->mount($micro);

$micro = new MicroCollection();
$micro->setHandler('Api\controllers\PaqueteController', true);
$micro->setPrefix('/paquete');
$micro->get('/', 'index');
$micro->get('/search', 'search');
$micro->get('/byId/{id:[0-9]+}', 'getElementById');
$micro->post('/post', 'post');
$micro->put('/put/{id:[0-9]+}', 'put');
$app->mount($micro);

$micro = new MicroCollection();
$micro->setHandler('Api\controllers\RestriccionController', true);
$micro->setPrefix('/restriccion');
$micro->get('/', 'index');
$micro->get('/search', 'search');
$micro->get('/byId/{id:[0-9]+}', 'getElementById');
$micro->post('/post', 'post');
$micro->put('/put/{id:[0-9]+}', 'put');
$app->mount($micro);

$micro = new MicroCollection();
$micro->setHandler('Api\controllers\UnidadnegocioController', true);
$micro->setPrefix('/unidadNegocio');
$micro->get('/', 'index');
$micro->get('/search', 'search');
$micro->get('/list', 'getListCatalog');
$micro->get('/byId/{id:[0-9]+}', 'getElementById');
$micro->post('/post', 'post');
$micro->put('/put/{id:[0-9]+}', 'put');
$app->mount($micro);

$micro = new MicroCollection();
$micro->setHandler('Api\controllers\UserController', true);
$micro->setPrefix('/user');
$micro->post('/login', 'postLogin');
// $micro->get('/', 'index');
// $micro->get('/search', 'search');
// $micro->get('/list', 'getListCatalog');
// $micro->get('/byId/{id:[0-9]+}', 'getElementById');
// $micro->post('/post', 'post');
// $micro->put('/put/{id:[0-9]+}', 'put');
$app->mount($micro);

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
