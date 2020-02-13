<?php

namespace Api\Helper;

/**
 * @author Felipe Tun <ftun@palaceresorts.com>
 * trait con funciones helper para la ejecucion de sentencia SQL
 */
trait TraitExecuteQuery
{
    /**
    * Funcion para ejecutar una sentencia SQL, obteniendo el response en json del array para servir como respuesta
    * @param string. SQL
    * @param array. BindParams
    * @return array.
    */
    public function getResponseQueryOne($sql, $params = [])
    {
        try {
            $data = $this->getQueryOne($sql, $params);
            return empty($data) ? $this->buildErrorResponse(404) : $this->buildSuccessResponse(200, 'Ok', $data);
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
    public function getResponseQueryAll($sql, $params = [])
    {
        try {
            $data = $this->getQueryAll($sql, $params);
            return empty($data) ? $this->buildErrorResponse(404) : $this->buildSuccessResponse(200, 'Ok', $data);
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
    public function getQueryOne($sql, $params = [])
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
    public function getQueryAll($sql, $params = [])
    {
        $db = $this->modelClass::getConnection();
        return $db->fetchAll($sql, \Phalcon\Db::FETCH_ASSOC, $params);
    }

    /**
    * Funcion para ejecutar una sentencia NOSQL Update / Insert / Delete
    * @param string. SQL
    * @return array
    */
    public function getExecute($sql)
    {
        $response = [
            'error' => true,
            'affectedRows' => 0,
            'message' => 'Statement Is Empty',
        ];

        if (empty($sql)) {
            return $response;
        }

        try {
            $db = $this->modelClass::getConnection();
            $db->execute($sql);
            $response['error'] = false;
            $response['affectedRows'] = $db->affectedRows();
        } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
        }

        return $response;
    }

    /**
     * Funcion que decodifica o codifica un campo json segun su modelo.
     * @param object
     * @param string
     * @param array
     */
    private function jsonDecodeDataArray(&$value, $key, $params)
    {
        if(in_array($key, $params[0])){
            $value = empty($value) ? ($params[1] ? json_encode([]) : array()) : ($params[1] ? json_encode($value) : json_decode($value, true));
        }
    }

    /**
     * Funcion para obtener los atributos json de un array o multi-array y decodificarlos o encodificarlos segun se requiera.
     * @param array
     * @param mixed
     * @param boolean
     * @return array
     */
    public function getRenderColumnsJSON($data, $arrayOrModel, $encode = false)
    {
        if(!empty($arrayOrModel)) {
            $attributesJSON =  is_array($arrayOrModel) ? $arrayOrModel : (new $arrayOrModel)->getColumnsJSON();
            if(isset($data[0]) && is_array($data[0])){
                array_walk_recursive($data, array($this,'jsonDecodeDataArray'),[$attributesJSON, $encode]);
            }else{
                array_walk($data,array($this,'jsonDecodeDataArray'),[$attributesJSON, $encode]);
            }
        }
        return $data;
    }
}
