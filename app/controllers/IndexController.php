<?php

namespace Api\controllers;

use Api\Helper\BController;

class IndexController extends BController
{

    public function getTest()
    {
        return $this->buildSuccessResponse(200);
    }
}
