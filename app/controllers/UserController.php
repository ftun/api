<?php

namespace Api\controllers;

use Api\Helper\BController;
use Api\models\AuthUser;

/**
 * @author Felipe Tun <felipe.tun.cauich@gmail.com.com>
 * Herendan los siguientes metodos del BController
 *      parent::index();
 *      parent::search();
 *      parent::searchPagination($limit, $offset);
 *      parent::post();
 *      parent::put($id);
 */
class UserController extends BController
{
    /**
    * @property. Object
    */
    public $modelClass = "Api\\models\\AuthUser";

    /**
    * Funcion que obtienen informacion de un elemento del modelo en base a su ID
    * @param /GET
    * @return JSON
    */
    public function getElementById($id)
    {
        $sql = "SELECT * FROM {$this->modelClass::getSource()} WHERE idauth_user = :id;";
        return $this->getResponseQueryOne($sql, ['id' => $id]);
    }

    /**
    * Metodo para logeo de usuarios
    */
    public function postLogin()
    {
        $post = $this->request->getJsonRawBody(true);
        if (empty($post['username']) || empty($post['password'])) return $this->buildErrorResponse(400, 'Bad Request');

        $data = $this->getQueryOne("SELECT * FROM {$this->modelClass::getSource()} WHERE username = :username;", ['username' => $post['username']]);
        if (empty($data)) return $this->buildErrorResponse(404, 'Usuario No Registrado');
        if ($data['estado'] == 0) return $this->buildErrorResponse(404, 'Usuario Inactivo');

        return $data['password'] === $post['password'] ?
            $this->buildSuccessResponse(200, 'ok') :
            $this->buildErrorResponse(400, 'Credenciales incorrectas');
    }
}
