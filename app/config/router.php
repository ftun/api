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

$Categoriacontrato = new MicroCollection();
$Categoriacontrato->setHandler('Api\controllers\ActividadController', true);
$Categoriacontrato->setPrefix('/actividad');
$Categoriacontrato->get('/', 'index');
$Categoriacontrato->get('/search', 'search');
$Categoriacontrato->get('/byId/{id:[0-9]+}', 'getElementById');
$Categoriacontrato->post('/post', 'post');
$Categoriacontrato->put('/put/{id:[0-9]+}', 'put');
$app->mount($Categoriacontrato);

$Categoriacontrato = new MicroCollection();
$Categoriacontrato->setHandler('Api\controllers\CategoriaController', true);
$Categoriacontrato->setPrefix('/categoria');
$Categoriacontrato->get('/', 'index');
$Categoriacontrato->get('/search', 'search');
$Categoriacontrato->get('/porUnidad/{unidad:[0-9]+}', 'getCategoriasPorUnidad');
$Categoriacontrato->get('/byId/{id:[0-9]+}', 'getElementById');
$Categoriacontrato->post('/post', 'post');
$Categoriacontrato->put('/put/{id:[0-9]+}', 'put');
$app->mount($Categoriacontrato);

$Categoriacontrato = new MicroCollection();
$Categoriacontrato->setHandler('Api\controllers\HorarioController', true);
$Categoriacontrato->setPrefix('/horario');
$Categoriacontrato->get('/', 'index');
$Categoriacontrato->get('/search', 'search');
$Categoriacontrato->get('/byId/{id:[0-9]+}', 'getElementById');
$Categoriacontrato->post('/post', 'post');
$Categoriacontrato->put('/put/{id:[0-9]+}', 'put');
$app->mount($Categoriacontrato);

$Categoriacontrato = new MicroCollection();
$Categoriacontrato->setHandler('Api\controllers\PaquetecategoriaController', true);
$Categoriacontrato->setPrefix('/paqueteCategoria');
$Categoriacontrato->get('/', 'index');
$Categoriacontrato->get('/search', 'search');
$Categoriacontrato->get('/byId/{id:[0-9]+}', 'getElementById');
$Categoriacontrato->post('/post', 'post');
$Categoriacontrato->put('/put/{id:[0-9]+}', 'put');
$app->mount($Categoriacontrato);

$Categoriacontrato = new MicroCollection();
$Categoriacontrato->setHandler('Api\controllers\PaqueteController', true);
$Categoriacontrato->setPrefix('/paquete');
$Categoriacontrato->get('/', 'index');
$Categoriacontrato->get('/search', 'search');
$Categoriacontrato->get('/byId/{id:[0-9]+}', 'getElementById');
$Categoriacontrato->post('/post', 'post');
$Categoriacontrato->put('/put/{id:[0-9]+}', 'put');
$app->mount($Categoriacontrato);

$Categoriacontrato = new MicroCollection();
$Categoriacontrato->setHandler('Api\controllers\RestriccionController', true);
$Categoriacontrato->setPrefix('/restriccion');
$Categoriacontrato->get('/', 'index');
$Categoriacontrato->get('/search', 'search');
$Categoriacontrato->get('/byId/{id:[0-9]+}', 'getElementById');
$Categoriacontrato->post('/post', 'post');
$Categoriacontrato->put('/put/{id:[0-9]+}', 'put');
$app->mount($Categoriacontrato);

$Categoriacontrato = new MicroCollection();
$Categoriacontrato->setHandler('Api\controllers\UnidadnegocioController', true);
$Categoriacontrato->setPrefix('/unidadNegocio');
$Categoriacontrato->get('/', 'index');
$Categoriacontrato->get('/search', 'search');
$Categoriacontrato->get('/byId/{id:[0-9]+}', 'getElementById');
$Categoriacontrato->post('/post', 'post');
$Categoriacontrato->put('/put/{id:[0-9]+}', 'put');
$app->mount($Categoriacontrato);

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
