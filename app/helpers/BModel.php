<?php

namespace Api\Helper;

use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Behavior\Timestampable;
use Phalcon\Mvc\Model\MetaData;
use Phalcon\Mvc\Model\Message;
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Uniqueness;
use Phalcon\Db\Column;

class BModel extends Model
{
    public $scenario = 'create';

	/**
     * Constantes para identificar el estado de los registros:
     */
    const ESTADO_INACTIVO = 0;
    const ESTADO_ACTIVO = 1;
    const ESTADO_CANCELADO = 2;

    use \Api\Helper\TraitExecuteQuery {
        \Api\Helper\TraitExecuteQuery::getRenderColumnsJSON as renderColumnsJSON;
    }

    public function initialize()
    {
        $this->useDynamicUpdate(true);
        $this->keepSnapshots(true);

        $this->addBehavior(
            new Timestampable(
                [
                    "beforeCreate" => [
                        "field"  => ["fecha_creacion", "fecha_ultima_modificacion"],
                        "format" => "Y-m-d H:i:s",
                    ],

                    'beforeUpdate' => [
				        "field"  => "fecha_ultima_modificacion",
				        "format" => "Y-m-d H:i:s",
				      ]
                ]
            )
        );
    }

    public function getAttributes()
    {
        $metaData = $this->getModelsMetaData();
        return $metaData->getAttributes($this);
    }

    public function getDataTypes()
    {
        $metaData = $this->getModelsMetaData();
        return $metaData->getDataTypes($this);
    }

    public function getPrimaryKey()
    {
        $metaData = $this->getModelsMetaData();
        return $metaData->getPrimaryKeyAttributes($this);
    }

    /**
    * Funcion para obtener los atributos del modelo requeridos. se obtienen descartando el primary key y los atributos por default
    * @return Array
    */
    public function getAttributesRequired()
    {
        $attributes = $this->metaData();
        return $this->scenario == 'create' ?
            array_diff($attributes[MetaData::MODELS_NON_PRIMARY_KEY], $attributes[MetaData::MODELS_AUTOMATIC_DEFAULT_INSERT]) :
            $attributes[MetaData::MODELS_ATTRIBUTES];
    }

    /**
    * Validador generico para los atributos requeridos y no nullos
    * @return Boolean
    */
    public function validation()
    {
        $validation = new Validation();

        $this->uniquenessValidation($validation);
        $this->PresenceOfValidation($validation);

        return $this->validate($validation);
    }

    /**
    * Funcion para obtener los mensajes de los atributos en base al metodo validation
    * @return Array
    */
    public function getMessagesErrors()
    {
        $messages = $this->getMessages();

        $erros = [];
        foreach ($messages as $message) {
            $erros[] = [
                "type error" => $message->getType(),
                "field" =>  $message->getField(),
                "message" => $this->getTypeError($message->getType()),
            ];
        }

        return $erros;
    }

    /**
    * Funcion uniquenessValidation Obtiene los atributos unicos del modelo [MetaData::MODELS_IDENTITY_COLUMN]
    * @return Array
    */
    public function uniquenessValidation(&$validation){

        $metaData = $this->getModelsMetaData();
        $attributesUniqueness = $metaData->getIdentityField($this);
        if (is_array($attributesUniqueness) && !empty($attributesUniqueness)) {
            foreach ($attributesUniqueness as $key => $attr) {
                $validation->add($attr, new Uniqueness());
            }
        }

        return;
    }

     /**
    * Funcion PresenceOfValidation Obtiene los atributos que son requeridos del modelo
    * @return Array
    */
    public function PresenceOfValidation(&$validation){
        $attributes = $this->getAttributesRequired();
        foreach ($attributes as $key => $attr) {
            $validation->add($attr, new PresenceOf());
        }
        return;

    }

   public function getTypeError($type)
    {
        $messages = '';
        switch ($type) {
                case "InvalidCreateAttempt":
                    $messages = "The record cannot be created because it already exists";
                    break;

                case "InvalidUpdateAttempt":
                    $messages = "The record cannot be updated because it doesn't exist";
                    break;

                case "PresenceOf":
                    $messages = "Is mandatory";
                    break;
                case "Uniqueness":
                 $messages = "The record must be unique";
                break;
            }
        return $messages;
    }

    /**
    * Funcion para obtener la instancia de la conexion a la base de datos
    * @param string. Especifica el modulo de la conexion a obtener. default 'db'
    */
    public static function getConnection($connection = 'db')
    {
        $di = \Phalcon\DI\FactoryDefault::getDefault();
        return $di->get($connection);
    }

    /**
     * Funcion para obtener los atributos del modelo que son de tipo json y los decodifica o encodifica segun se requiera
    * @param array
    * @param boolean
    * @return array
    */
    public function getRenderColumnsJSON($data, $encode = false)
    {
        return  $this->renderColumnsJSON($data, $this->getColumnsJSON(), $encode);
    }

    /**
    * Funcion para obtener los atributos del modelo que son de tipo json y los decodifica o encodifica segun se requiera
    * @return array
    */
    public function getColumnsJSON()
    {
        $attributes = $this->metaData();
        $attributes = $attributes[MetaData::MODELS_DATA_TYPES];
        $attributesJSON = array_keys(array_filter($attributes, function ($key) {
            return ($key === Column::TYPE_JSON);
        }));

        return $attributesJSON;
    }
}
