<?php

namespace Api\controllers;

use Api\Helper\modelGenerator\Generator;
use Phalcon\Mvc\Controller;

/**
 * @author Felipe Tun <ftun@palaceresorts.com>
 */
class GeneratorcodeController extends Controller
{
    public $namespaceModels = '/models';
    public $namespaceControllers = '/controllers';

    public function index()
    {
        return json_encode([
            'code' => 200,
            'status' => 'sucess',
            'message' => 'susscesful access',
            'payload' => [],
        ]);
    }

    /**
     * Funcion para ejecutar la clase del generador de codigo
     * @param string nombre de la tabla
     * @param string nombre del modulo
     * @return mixed
     */
    public function getCode($table, $module = "")
    {
        $models = !empty($module) ? ($this->namespaceModels . $module) : $this->namespaceModels;
        $controllers = !empty($module) ? ($this->namespaceControllers . $module) : $this->namespaceControllers;
        $generate = new Generator($table, $models, $controllers, $this->dbParams);
        return json_encode([
            'model' => $generate->getModel(),
            'controller' => $generate->getController(),
        ]);
    }
}
