<?php

namespace Api\models;

use Phalcon\Db\Column;
use Api\Helper\BlameableModel;
use Phalcon\Mvc\Model\MetaData;

/**
 * Clase para el uso como template del modelo
 * @author Felipe Tun <ftun@palaceresorts.com>
 */
class DefHorario extends BlameableModel
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
    			
				'iddef_horario',
				'iddef_actividad',
				'inicio',
				'fin',
				'iddef_horario',
				'iddef_actividad',
				'descripcion',
				'estado',
				'fecha_creacion',
				'usuario_creacion',
				'usuario_ultima_modificacion',
				'fecha_ultima_modificacion',

    		],

                // Atributos que SI son llaves primarias de la tabla

    		MetaData::MODELS_PRIMARY_KEY => [
    			
				'iddef_horario',
				'iddef_horario',

    		],

                // Atributos que NO son llaves primarias de la tabla

    		MetaData::MODELS_NON_PRIMARY_KEY => [
    			
				'iddef_actividad',
				'inicio',
				'fin',
				'iddef_actividad',
				'descripcion',
				'estado',
				'fecha_creacion',
				'usuario_creacion',
				'usuario_ultima_modificacion',
				'fecha_ultima_modificacion',

    		],

                // Atributos que no permiten valores NULL

    		MetaData::MODELS_NOT_NULL => [
                
				'iddef_horario',
				'iddef_actividad',
				'inicio',
				'fin',
				'iddef_horario',
				'iddef_actividad',
				'descripcion',
				'estado',
				'fecha_creacion',
				'usuario_creacion',
				'usuario_ultima_modificacion',
				'fecha_ultima_modificacion',

    		],

                // Atributos y sus tipos de datos

    		MetaData::MODELS_DATA_TYPES => [
    			
				'iddef_horario' => Column::TYPE_INTEGER,
				'iddef_actividad' => Column::TYPE_INTEGER,
				'inicio' => Column::TYPE_VARCHAR,
				'fin' => Column::TYPE_VARCHAR,
				'iddef_horario' => Column::TYPE_INTEGER,
				'iddef_actividad' => Column::TYPE_INTEGER,
				'descripcion' => Column::TYPE_VARCHAR,
				'estado' => Column::TYPE_INTEGER,
				'fecha_creacion' => Column::TYPE_DATETIME,
				'usuario_creacion' => Column::TYPE_VARCHAR,
				'usuario_ultima_modificacion' => Column::TYPE_VARCHAR,
				'fecha_ultima_modificacion' => Column::TYPE_DATETIME,

    		],

                // Atributos con tipo de datos Integer

    		MetaData::MODELS_DATA_TYPES_NUMERIC => [
    			
				'iddef_horario' => Column::TYPE_INTEGER,
				'iddef_actividad' => Column::TYPE_INTEGER,
				'iddef_horario' => Column::TYPE_INTEGER,
				'iddef_actividad' => Column::TYPE_INTEGER,
				'estado' => Column::TYPE_INTEGER,

    		],

                // Atributos y el tipo de cast que se debe aplicar

    		MetaData::MODELS_DATA_TYPES_BIND => [
    			
				'iddef_horario' => Column::BIND_PARAM_INT,
				'iddef_actividad' => Column::BIND_PARAM_INT,
				'inicio' => Column::BIND_PARAM_STR,
				'fin' => Column::BIND_PARAM_STR,
				'iddef_horario' => Column::BIND_PARAM_INT,
				'iddef_actividad' => Column::BIND_PARAM_INT,
				'descripcion' => Column::BIND_PARAM_STR,
				'estado' => Column::BIND_PARAM_INT,
				'fecha_creacion' => Column::BIND_PARAM_STR,
				'usuario_creacion' => Column::BIND_PARAM_STR,
				'usuario_ultima_modificacion' => Column::BIND_PARAM_STR,
				'fecha_ultima_modificacion' => Column::BIND_PARAM_STR,

    		],

                // Atributos y sus valores predeterminados

    		MetaData::MODELS_DEFAULT_VALUES => [
    		    
				'iddef_actividad' => 0,
				'inicio' => ' ',
				'fin' => ' ',
				'iddef_actividad' => 0,
				'descripcion' => ' ',
				'estado' => 1,
				'fecha_creacion' => '1000-01-01 00:00:00',
				'usuario_creacion' => ' ',
				'usuario_ultima_modificacion' => ' ',
				'fecha_ultima_modificacion' => '1000-01-01 00:00:00',

    		],

                // Atributos que permiten cadenas vacias

    		MetaData::MODELS_EMPTY_STRING_VALUES => [
    			
				'inicio' => true,
				'fin' => true,
				'descripcion' => true,
				'usuario_creacion' => true,
				'usuario_ultima_modificacion' => true,

    		],

                // Atributos a ignorar en las sentencias INSERT SQL

    		MetaData::MODELS_AUTOMATIC_DEFAULT_INSERT => [
                'usuario_ultima_modificacion',
                'fecha_ultima_modificacion',
                'fecha_creacion',
    			
				'iddef_horario' => true,
				'iddef_horario' => true,

    		],


            // Atributo identidad de la tabla, especificar el atributo, si no existe un atributo identidad especificar un boolean en 'false'
            MetaData::MODELS_IDENTITY_COLUMN => 
				'iddef_horario',
				'iddef_horario',



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
        return "def_horario";
    }
}
