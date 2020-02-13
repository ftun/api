<?php
use Phalcon\Http\Request\Exception;
use Phalcon\Mvc\Micro;

define('APPLICATION_ENV', 'dev');
define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app');
define('ALLOWEDMETHODS', ['PUT', 'PATCH', 'POST']);

// if (APPLICATION_ENV === 'dev') {
//     // ini_set('display_errors', "On");
//     // error_reporting(E_ALL);
//     // $debug = new Phalcon\Debug();
//     // $debug->listen();
// }

try {

    /**
     *  Include Vendor directory
     */
    // require __DIR__ . '/../vendor/autoload.php';

    /*
     * Read the configuration
     */
    $config = include APP_PATH . '/config/config.php';

    /**
     * Include Autoloader.
     */
    include APP_PATH . '/config/loader.php';
    
    /**
     * Include Services.
     */

    // Initializing DI container
    /** @var \Phalcon\DI\FactoryDefault $di */

    include APP_PATH . '/config/services.php';

    /*
     * Starting the application
     * Assign service locator to the application
     */

    $app = new Micro($di);

    /**
     * Tratamiento de las peticiones de metodos http seguros, permitiendo metodos idempotentes
     */
    $is_nginx = strpos(strtoupper($_SERVER['SERVER_SOFTWARE']), 'NGINX') !== false;

    if(!function_exists('apache_request_headers') || $is_nginx)
    {
        /**
         * Tratamiento de las peticiones de metodos http seguros, permitiendo metodos idempotentes
         */
        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
            if (in_array($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'], ALLOWEDMETHODS)) {
                $_SERVER['REQUEST_METHOD'] = $_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'];
            }
        }
        $app->response
            ->setHeader('Access-Control-Allow-Origin', '*')
            ->setHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, PATCH, OPTIONS')
        # ->setHeader('Access-Control-Allow-Credentials', 'true')
            ->setHeader('Access-Control-Allow-Headers', 'Origin, X-Requested-With, Content-Range, Content-Disposition, Content-Type, Authorization, X-HTTP-Method-Override')
        ;
    }

    /**
     * Include Application.
     */
    include APP_PATH . '/config/router.php';

    /*
     * Handle the request
     */
    $app->handle();

} catch (\Exception $e) {
    if (APPLICATION_ENV === 'dev') {
        echo $e->getMessage() . '<br>';
        echo '<pre>' . $e->getTraceAsString() . '</pre>';
    }
}
