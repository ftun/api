<?php

namespace Api\Helper;

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
        return $this->getResponseQueryAll("SELECT * FROM {$this->modelClass::getSource()} LIMIT $limit OFFSET $offset");
    }

    /**
     * Funcion que retorna toda la lista de elementos del modelo
     * @return JSON
     */
    public function search()
    {
        return $this->getResponseQueryAll("SELECT * FROM {$this->modelClass::getSource()}");
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


    /**
    * Funcion para ejecutar una sentencia SQL, obteniendo el response en json del array para servir como respuesta
    * @param string. SQL
    * @param array. BindParams
    * @return array.
    */
    protected function getResponseQueryOne($sql, $params = [])
    {
        try {
            $data = $this->getQueryOne($sql, $params);
            return empty($data) ? $this->buildErrorResponse(404,  "Not Found") : $this->buildSuccessResponse(200, 'Ok', $data);
        } catch (\Exception $e) {
            return $this->buildErrorResponse(500, $e->getMessage());
        }
    }

    /**
    * Funcion para ejecutar una sentencia SQL, obteniendo el response en json del multiarray para servir como respuesta
    * @param string. SQL
    * @param array. BindParams
    * @return array.
    */
    protected function getResponseQueryAll($sql, $params = [])
    {
        try {
            $data = $this->getQueryAll($sql, $params);
            return empty($data) ? $this->buildErrorResponse(404, "Not Found") : $this->buildSuccessResponse(200, 'Ok', $data);
        } catch (\Exception $e) {
            return $this->buildErrorResponse(500, $e->getMessage());
        }
    }

    /**
    * Funcion para ejecutar una sentencia SQL, obteniendo los datos en un multiarray asociativo de los datos
    * @param string. SQL
    * @param array. BindParams
    * @return array.
    */
    protected function getQueryOne($sql, $params = [])
    {
        $db = $this->modelClass::getConnection();
        return $db->fetchOne($sql, \Phalcon\Db::FETCH_ASSOC, $params);
    }

    /**
    * Funcion para ejecutar una sentencia SQL, obteniendo los datos en un multiarray asociativo de los datos
    * @param string. SQL
    * @param array. BindParams
    * @return array.
    */
    protected function getQueryAll($sql, $params = [])
    {
        $db = $this->modelClass::getConnection();
        return $db->fetchAll($sql, \Phalcon\Db::FETCH_ASSOC, $params);
    }

    /**
    * Se obtiene una lista asociativa clave => valor
    * @return mixed
    */
    protected function getListAssoc($key, $value) {
        $data = $this->getQueryAll("SELECT $key, $value FROM {$this->modelClass::getSource()}");
        if (empty($data)) return $this->buildErrorResponse(404);

        $data = array_column($data, $value, $key);
        return $this->buildSuccessResponse(200, '', $data);
    }
}
