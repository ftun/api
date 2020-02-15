<?php

namespace Api\controllers;

use Api\Helper\BController;
use Api\models\DefCategoria;

/**
 * @author Felipe Tun <felipe.tun.cauich@gmail.com.com>
 * Herendan los siguientes metodos del BController
 *      parent::index();
 *      parent::search();
 *      parent::searchPagination($limit, $offset);
 *      parent::post();
 *      parent::put($id);
 */
class CategoriaController extends BController
{
    /**
    * @property. Object
    */
    public $modelClass = "Api\\models\\DefCategoria";

    /**
    * Funcion que obtienen informacion de un elemento del modelo en base a su ID
    * @param /GET
    * @return JSON
    */
    public function getElementById($id)
    {
        $sql = "SELECT * FROM {$this->modelClass::getSource()} WHERE iddef_categoria = :id;";
        return $this->getResponseQueryOne($sql, ['id' => $id]);
    }

    /**
    * Se obtienen las categorias por unidad de negocio, en relacion padre (categorias) e hijo (subcategorias)
    * en el FE - Home
    */
    public function getCategoriasPorUnidad($unidad)
    {
        $sql =
        "SELECT
            iddef_categoria, iddef_categoria_padre, descripcion
        FROM
            def_categoria
        WHERE
                iddef_unidad_negocio = :unidad
            AND estado = 1
        ORDER BY iddef_categoria_padre ASC;
        ";

        $data = $this->getQueryAll($sql, ['unidad' => $unidad]);
        if (empty($data)) return $this->buildSuccessResponse(404);
        $newData = [];
        foreach ($data as $key => $value) {
                if ($value['iddef_categoria_padre'] == 0) {
                    $newData[$value['iddef_categoria']] = [
                        'descripcion' => $value['descripcion'],
                        'hijos' => [],
                    ];
                } else {
                    $newData[$value['iddef_categoria_padre']]['hijos'][] = $value['descripcion'];
                }
        }

        return $this->buildSuccessResponse(200, '', $newData);
    }

    /**
    * Se obtiene una lista asociativa para el join de datos en el FE
    * @return mixed
    */
    public function getListCatalog()
    {
        return $this->getListAssoc('iddef_categoria', 'descripcion');
    }
}
