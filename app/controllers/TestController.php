<?php

namespace Api\controllers;

use Api\Helper\BController;

/**
 *
 */
class TestController extends BController
{

    public function index()
    {
        return parent::index();
    }

    public function getTest()
    {
        return $this->getResponseQueryAll("SELECT * FROM def_unidad_negocio");
    }
}
