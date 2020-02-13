<?php

namespace Api@@NAMESPACE;

use Api\Helper\BController;
use Api@@USE\@@MODEL;

/**
 * @author Felipe Tun <felipe.tun.cauich@gmail.com.com>
 * Herendan los siguientes metodos del BController
 *      parent::index();
 *      parent::search();
 *      parent::searchPagination($limit, $offset);
 *      parent::post();
 *      parent::put($id);
 */
class @@CLASSNAME extends BController
{
    /**
    * @property. Object
    */
    public $modelClass = "@@RERERENCIA";

    /**
    * Funcion que obtienen informacion de un elemento del modelo en base a su ID
    * @param /GET
    * @return JSON
    */
    public function getElementById($id)
    {
        $sql = "SELECT * FROM {$this->modelClass::getSource()} WHERE @@IDTABLE = :id;";
        return $this->getResponseQueryOne($sql, ['id' => $id]);
    }
}
