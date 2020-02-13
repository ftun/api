<?php

namespace Api\controllers;

use Phalcon\Di\Injectable;
use Phalcon\Http\request;
use Phalcon\Http\Response;
use Phalcon\Mvc\Controller;
use Phalcon\Mvc\ControllerInterface;

/**
 *
 */
class BController extends Injectable implements ControllerInterface
{
    /**
     * @property string. Almacena el entorno de la aplicacion en base a la variable declarada en el archivo: public/index.php
     * dev => Desarrollo
     * qa => Calidad
     * pro => Produccion
     */
    const ENVIRONMENT = APPLICATION_ENV;

    /**
    * @property array. Codigos para el response
    */
    public $statusCode = [
        200 => 'Ok',
        201 => 'Create',
        202 => 'Accept',
        203 => 'Non-Authoritative Information',
        204 => 'No Content',
        400 => 'Bad Request',
        401 => 'Unauthorized',
        403 => 'Forbidden',
        404 => 'Not Found',
        409 => 'Conflict',
    ];

    /**
     * @var $modelClass. Se almacena la instancia del modelo referente al controlador que los hereda
     */
    public $modelClass;


    public function index()
    {
        $response = [
            'code' => 200,
            'status' => 'sucess',
            'message' => 'susscesful access',
            'payload' => [],
        ];
        $this->response->setJsonContent($response);
        $this->response->setStatusCode(200);
        return $this->response->send();
    }

    /**
     * Funcion para la creacion de nuevos registros
     * @param request JSON
     * @return array $response
     */
    public function post()
    {
        try {
            $post = $this->request->getJsonRawBody(true);
            $model = new $this->modelClass;
            $attr = $model->getAttributesRequired();
            $post = $model->getRenderColumnsJSON($post, true);

            if ($model->save($post, $attr)) {
                $primary = isset($model->getPrimaryKey()[0]) ? $model->getPrimaryKey()[0] : null;
                return $this->buildSuccessResponse(201, '', ['id' => $model->toArray()[$primary]]);
            } else {
                return $this->buildErrorResponse(400, $model->getMessagesErrors());
            }
        } catch (\Exception $e) {
            return $this->buildErrorResponse(500, $e->getMessage());
        }
    }

    /**
     * Funcion para la actualizacion de registros existentes
     * @param integer id del registro a actualizar
     * @param request JSON
     * @return array $response
     */
    public function put($id)
    {
        try {
            $put = $this->request->getJsonRawBody(true);
            $model = new $this->modelClass;
            $model->scenario = 'update';
            $attr = $model->getAttributesRequired();

            if ($model = $model::findFirst($id)) {
                if ($model->save($put, $attr)) {
                    return $this->buildSuccessResponse(204);
                } else {
                    return $this->buildErrorResponse(400, $model->getMessagesErrors());
                }
            } else {
                return $this->buildErrorResponse(404);
            }

        } catch (\Exception $e) {
            return $this->buildErrorResponse(500, $e->getMessage());
        }
    }


    /**
     * Funcion que retorna toda la lista de elementos del modelo
     * @return JSON
     */
    public function searchPagination($limit, $offset)
    {
        try {
            $data = $this->modelsManager->createQuery("SELECT * FROM $this->modelClass LIMIT $limit OFFSET $offset")->execute();
            $this->response->setStatusCode(200);
            $this->response->setJsonContent($data);
            return $this->response->send();
        } catch (\Exception $e) {
            $this->response->setStatusCode(500);
            $this->response->setJsonContent($e->getMessage());
            return $this->response->send();
        }
    }

    /**
     * Funcion que retorna toda la lista de elementos del modelo
     * @return JSON
     */
    public function search()
    {
        try {
            $data = $this->modelsManager->createQuery("SELECT * FROM $this->modelClass")->execute();
            $this->response->setStatusCode(200);
            $this->response->setJsonContent($data);
            return $this->response->send();
        } catch (\Exception $e) {
            $this->response->setStatusCode(500);
            $this->response->setJsonContent($e->getMessage());
            return $this->response->send();
        }
    }

    /**
     * Funcion para obtener la fecha actual
     * @param string. especifica la zona horaria, por default cancun
     * @return object
     */
    public function getCurrentDate($zone = 'America/Cancun')
    {
        $DateTimeZone = new \DateTimeZone($zone);
        $dateTime = new \DateTime();
        $dateTime->setTimezone($DateTimeZone);
        return $dateTime;
    }

    /**
    * Builds error responses.
    * @param integer
    * @param string
    * @param array
    * @return json
    */
    protected function buildErrorResponse($code, $messages = '', $data = [])
    {
        $status = isset($this->statusCode[$code]) ? $this->statusCode[$code] : '';
        $response = [
            "status" => $status,
            "code" => $code,
            "message" => $messages,
            "data" => $data,
            "error" => true,
        ];

        $this->response->setStatusCode($code, $status);
        $this->response->setJsonContent($response);
        return $this->response->send();
    }

    /**
    * Builds success responses.
    * @param integer
    * @param string
    * @param array
    * @return json
    */
    protected function buildSuccessResponse($code, $messages = '', $data = [])
    {
        $status = isset($this->statusCode[$code]) ? $this->statusCode[$code] : '';
        $response = [
            "status" => $status,
            "code" => $code,
            "message" => $messages,
            "data" => $data,
            "error" => false,
        ];

        $this->response->setStatusCode($code, $status);
        $this->response->setJsonContent($response);
        return $this->response->send();
    }
}
