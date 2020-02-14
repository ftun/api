<?php

namespace Api\controllers;

use Api\Helper\BController;
use Api\models\DefActividad;

/**
 * @author Felipe Tun <felipe.tun.cauich@gmail.com.com>
 * Herendan los siguientes metodos del BController
 *      parent::index();
 *      parent::search();
 *      parent::searchPagination($limit, $offset);
 *      parent::post();
 *      parent::put($id);
 */
class ActividadController extends BController
{
    /**
    * @property. Object
    */
    public $modelClass = "Api\\models\\DefActividad";

    /**
    * Funcion que obtienen informacion de un elemento del modelo en base a su ID
    * @param /GET
    * @return JSON
    */
    public function getElementById($id)
    {
        $sql = "SELECT * FROM {$this->modelClass::getSource()} WHERE iddef_actividad = :id;";
        return $this->getResponseQueryOne($sql, ['id' => $id]);
    }

    /**
    * Se obtiene las actividades de una categoria
    * @param integer
    * @return array
    */
    public function getActividadPorCategoria($category)
    {
        $sql = "SELECT * FROM {$this->modelClass::getSource()} WHERE iddef_categoria = :category;";
        return $this->getResponseQueryAll($sql, ['category' => $category]);
    }
}
