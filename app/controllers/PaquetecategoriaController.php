<?php

namespace Api\controllers;

use Api\Helper\BController;
use Api\models\DefPaqueteCategoria;

/**
 * @author Felipe Tun <felipe.tun.cauich@gmail.com.com>
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
class PaquetecategoriaController extends BController
{
    /**
    * @property. Object
    */
    public $modelClass = "Api\\models\\DefPaqueteCategoria";
    
    /**
    * Funcion que obtienen informacion de un elemento del modelo en base a su ID
    * @param /GET
    * @return JSON
    */
    public function getElementById($id)
    {
        $sql = "SELECT * FROM {$this->modelClass::getSource()} WHERE iddef_paquete_categoria = :id;";
        return $this->getResponseQueryOne($sql, ['id' => $id]);
    }
}
