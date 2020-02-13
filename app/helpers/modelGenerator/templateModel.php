<?php

namespace Api@@NAMESPACE;

use Phalcon\Db\Column;
use Api\Helper\BModel;
use Phalcon\Mvc\Model\MetaData;

/**
 * Clase para el uso como template del modelo
 * @author Felipe Tun <ftun@palaceresorts.com>
 */
class @@CLASSNAME extends BModel
{
    /**
    * Funcion que retorna los metadatos del modelo de la tabla
    * @return Array
    */
    public function metaData()
    {
        return [
            // Atributos de la tabla

    		MetaData::MODELS_ATTRIBUTES => [
    			@@MODELS_ATTRIBUTES
    		],

                // Atributos que SI son llaves primarias de la tabla

    		MetaData::MODELS_PRIMARY_KEY => [
    			@@MODELS_PRIMARY_KEY
    		],

                // Atributos que NO son llaves primarias de la tabla

    		MetaData::MODELS_NON_PRIMARY_KEY => [
    			@@MODELS_NON_PRIMARY_KEY
    		],

                // Atributos que no permiten valores NULL

    		MetaData::MODELS_NOT_NULL => [
                @@MODELS_NOT_NULL
    		],

                // Atributos y sus tipos de datos

    		MetaData::MODELS_DATA_TYPES => [
    			@@MODELS_DATA_TYPES_TOTALS
    		],

                // Atributos con tipo de datos Integer

    		MetaData::MODELS_DATA_TYPES_NUMERIC => [
    			@@MODELS_DATA_TYPES_NUMERIC
    		],

                // Atributos y el tipo de cast que se debe aplicar

    		MetaData::MODELS_DATA_TYPES_BIND => [
    			@@MODELS_DATA_TYPES_BIND
    		],

                // Atributos y sus valores predeterminados

    		MetaData::MODELS_DEFAULT_VALUES => [
    		    @@MODELS_DEFAULT_VALUES
    		],

                // Atributos que permiten cadenas vacias

    		MetaData::MODELS_EMPTY_STRING_VALUES => [
    			@@MODELS_EMPTY_STRING_VALUES
    		],

                // Atributos a ignorar en las sentencias INSERT SQL

    		MetaData::MODELS_AUTOMATIC_DEFAULT_INSERT => [
                'usuario_ultima_modificacion',
                'fecha_ultima_modificacion',
                'fecha_creacion',
    			@@MODELS_AUTOMATIC_DEFAULT_INSERT
    		],


            // Atributo identidad de la tabla, especificar el atributo, si no existe un atributo identidad especificar un boolean en 'false'
            MetaData::MODELS_IDENTITY_COLUMN => @@MODELS_PRIMARY_KEY


            // Atributos a ignorar en las sentencias UPDATE SQL
            MetaData::MODELS_AUTOMATIC_DEFAULT_UPDATE => [
                'fecha_creacion',
                'usuario_creacion',
            ],
        ];

    }

    /**
    * Nombre de la tabla referente al modelo
    * @return string
    */
    public function getSource()
    {
        return "@@TABLESOURCE";
    }
}
