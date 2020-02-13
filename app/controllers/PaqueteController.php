<?php

namespace Api\controllers;

use Api\Helper\BController;
use Api\models\DefPaquete;

/**
 * @author Felipe Tun <ftun@palaceresorts.com>
 * Herendan los siguientes metodos del BController
 *      parent::index();
 *      parent::search();
 *      parent::searchPagination($limit, $offset);
 *      parent::post();
 *      parent::put($id);
 *      parent::getListAssoc($key, $value);
 *      parent::getLog($id);
 *      parent::getDataDropDownSimple($key, $value);
 */
class PaqueteController extends BController
{
    /**
    * @property. Object
    */
    public $modelClass = "Api\\models\\DefPaquete";

    /**
    * Implementacion trait para ejecucion de querys
    */
    // use \Api\Helper\TraitExecuteQuery;

    /**
    * Funcion que obtienen informacion de un elemento del modelo en base a su ID
    * @param /GET
    * @return JSON
    */
    public function getElementById($id)
    {
        $sql = "SELECT * FROM {$this->modelClass::getSource()} WHERE iddef_paquete = :id;";
        return $this->getResponseQueryOne($sql, ['id' => $id]);
    }
}