<?php

namespace Api\models;

use Phalcon\Db\Column;
use Api\Helper\BModel;
use Phalcon\Mvc\Model\MetaData;

/**
 * Clase para el uso como template del modelo
 * @author Felipe Tun <felipe.tun.cauich@gmail.com.com>
 */
class DefActividad extends BModel
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

				'iddef_actividad',
				'iddef_categoria',
				'descripcion',
				'detalle_actividad',
				'iddef_actividad',
				'iddef_categoria',
				'descripcion',
				'estado',
				'fecha_creacion',
				'usuario_creacion',
				'usuario_ultima_modificacion',
				'fecha_ultima_modificacion',

    		],

                // Atributos que SI son llaves primarias de la tabla

    		MetaData::MODELS_PRIMARY_KEY => [

				'iddef_actividad',
				'iddef_actividad',

    		],

                // Atributos que NO son llaves primarias de la tabla

    		MetaData::MODELS_NON_PRIMARY_KEY => [

				'iddef_categoria',
				'descripcion',
				'detalle_actividad',
				'iddef_categoria',
				'descripcion',
				'estado',
				'fecha_creacion',
				'usuario_creacion',
				'usuario_ultima_modificacion',
				'fecha_ultima_modificacion',

    		],

                // Atributos que no permiten valores NULL

    		MetaData::MODELS_NOT_NULL => [

				'iddef_actividad',
				'iddef_categoria',
				'descripcion',
				'detalle_actividad',
				'iddef_actividad',
				'iddef_categoria',
				'descripcion',
				'estado',
				'fecha_creacion',
				'usuario_creacion',
				'usuario_ultima_modificacion',
				'fecha_ultima_modificacion',

    		],

                // Atributos y sus tipos de datos

    		MetaData::MODELS_DATA_TYPES => [

				'iddef_actividad' => Column::TYPE_INTEGER,
				'iddef_categoria' => Column::TYPE_INTEGER,
				'descripcion' => Column::TYPE_VARCHAR,
				'detalle_actividad' => Column::TYPE_VARCHAR,
				'iddef_actividad' => Column::TYPE_INTEGER,
				'iddef_categoria' => Column::TYPE_INTEGER,
				'descripcion' => Column::TYPE_VARCHAR,
				'estado' => Column::TYPE_INTEGER,
				'fecha_creacion' => Column::TYPE_DATETIME,
				'usuario_creacion' => Column::TYPE_VARCHAR,
				'usuario_ultima_modificacion' => Column::TYPE_VARCHAR,
				'fecha_ultima_modificacion' => Column::TYPE_DATETIME,

    		],

                // Atributos con tipo de datos Integer

    		MetaData::MODELS_DATA_TYPES_NUMERIC => [

				'iddef_actividad' => Column::TYPE_INTEGER,
				'iddef_categoria' => Column::TYPE_INTEGER,
				'iddef_actividad' => Column::TYPE_INTEGER,
				'iddef_categoria' => Column::TYPE_INTEGER,
				'estado' => Column::TYPE_INTEGER,

    		],

                // Atributos y el tipo de cast que se debe aplicar

    		MetaData::MODELS_DATA_TYPES_BIND => [

				'iddef_actividad' => Column::BIND_PARAM_INT,
				'iddef_categoria' => Column::BIND_PARAM_INT,
				'descripcion' => Column::BIND_PARAM_STR,
				'detalle_actividad' => Column::BIND_PARAM_STR,
				'iddef_actividad' => Column::BIND_PARAM_INT,
				'iddef_categoria' => Column::BIND_PARAM_INT,
				'descripcion' => Column::BIND_PARAM_STR,
				'estado' => Column::BIND_PARAM_INT,
				'fecha_creacion' => Column::BIND_PARAM_STR,
				'usuario_creacion' => Column::BIND_PARAM_STR,
				'usuario_ultima_modificacion' => Column::BIND_PARAM_STR,
				'fecha_ultima_modificacion' => Column::BIND_PARAM_STR,

    		],

                // Atributos y sus valores predeterminados

    		MetaData::MODELS_DEFAULT_VALUES => [

				'iddef_categoria' => 0,
				'descripcion' => ' ',
				'detalle_actividad' => ' ',
				'iddef_categoria' => 0,
				'descripcion' => ' ',
				'estado' => 1,
				'fecha_creacion' => '1000-01-01 00:00:00',
				'usuario_creacion' => ' ',
				'usuario_ultima_modificacion' => ' ',
				'fecha_ultima_modificacion' => '1000-01-01 00:00:00',

    		],

                // Atributos que permiten cadenas vacias

    		MetaData::MODELS_EMPTY_STRING_VALUES => [

				'descripcion' => true,
				'detalle_actividad' => true,
				'descripcion' => true,
				'usuario_creacion' => true,
				'usuario_ultima_modificacion' => true,

    		],

                // Atributos a ignorar en las sentencias INSERT SQL

    		MetaData::MODELS_AUTOMATIC_DEFAULT_INSERT => [
                'usuario_ultima_modificacion',
                'fecha_ultima_modificacion',
                'fecha_creacion',

				'iddef_actividad' => true,
				'iddef_actividad' => true,

    		],


            // Atributo identidad de la tabla, especificar el atributo, si no existe un atributo identidad especificar un boolean en 'false'
            MetaData::MODELS_IDENTITY_COLUMN =>
				'iddef_actividad',
				'iddef_actividad',



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
        return "def_actividad";
    }
}
