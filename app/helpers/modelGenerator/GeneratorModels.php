<?php

namespace Api\Helper\modelGenerator;

/**
 * Clase para el generardor de codigo del modelo
 * @author Felipe Tun <felipe.tun.cauich@gmail.com.com>
 */
class GeneratorModels
{
    public $tableName;
    public static $conexion;
    public $dbParams;

    public function __construct($tableName, $dbParams)
    {
        $this->tableName = $tableName;
        $this->dbParams = $dbParams;
        $this->getConnection();
    }

    /**
     * Funcion para obtener la conexion a la BDS
     * @return
     */
    public function getConnection()
    {
        self::$conexion = mysqli_connect($this->dbParams['host'], $this->dbParams['username'], $this->dbParams['password'], $this->dbParams['dbname']);
        if (mysqli_connect_errno()) {
            die("Failed to connect to MySQL: " . mysqli_connect_error());
        }
    }

    /**
     * Funcion para cerrar la conexion de la BDS
     * @return
     */
    public function setCloseConnection()
    {
        mysqli_close(self::$conexion);
    }

    /**
     * Funcion para obtener los atributos de la tabla
     * MODELS_ATTRIBUTES
     * @return String
     */
    public function getModelAttributes()
    {
        $sql = "SELECT COLUMN_NAME FROM information_schema.columns WHERE table_name = '$this->tableName';";

        return self::getDataColumnName($sql);
    }

    /**
     * Funcion para obtener las llaves primarias
     * MODELS_PRIMARY_KEY
     * @return String
     */
    public function getModelPrimaryKeys()
    {
        $sql = "SELECT COLUMN_NAME FROM information_schema.columns WHERE table_name = '$this->tableName' AND COLUMN_KEY = 'PRI';";

        return self::getDataColumnName($sql);
    }

    /**
     * Funcion para obtener los atributos que no son llaves primarias
     * MODELS_NON_PRIMARY_KEY
     * @return String
     */
    public function getModelNonPrimaryKeys()
    {
        $sql = "SELECT COLUMN_NAME FROM information_schema.columns WHERE table_name = '$this->tableName' AND COLUMN_KEY <> 'PRI';";

        return self::getDataColumnName($sql);
    }

    /**
     * Funcion para obtner los atributos que no pueden ser nullos
     * MODELS_NOT_NULL
     * @return String
     */
    public function getModelNotNull()
    {
        $sql = "SELECT COLUMN_NAME FROM information_schema.columns WHERE table_name = '$this->tableName' AND IS_NULLABLE = 'NO';";

        return self::getDataColumnName($sql);
    }

    /**
     *  Funcion para obtener el tipo de datos de los atributos
     * MODELS_DATA_TYPES
     * @return String
     */
    public function getModelDataTypes()
    {
        $sql =
        "SELECT
            COLUMN_NAME,
            CASE
                WHEN DATA_TYPE IN ('int' , 'bigint', 'mediumint', 'smallint', 'tinyint', 'float', 'double') THEN 'Column::TYPE_INTEGER'
                WHEN DATA_TYPE = 'decimal' THEN 'Column::TYPE_DECIMAL'
                WHEN DATA_TYPE IN ('date', 'year') THEN 'Column::TYPE_DATE'
                WHEN DATA_TYPE = 'datetime' THEN 'Column::TYPE_DATETIME'
                WHEN DATA_TYPE = 'timestamp' THEN 'Column::TYPE_TIMESTAMP'
                WHEN DATA_TYPE = 'varchar' THEN 'Column::TYPE_VARCHAR'
                WHEN DATA_TYPE = 'char' THEN 'Column::TYPE_CHAR'
                WHEN DATA_TYPE IN ('text', 'mediumtext', 'longtext') THEN 'Column::TYPE_TEXT'
                WHEN DATA_TYPE = 'json' THEN 'Column::TYPE_JSON'
                ELSE ''
			END AS DATA_TYPE
        FROM
            information_schema.columns
        WHERE
            table_name = '$this->tableName';
        ";

        return self::getDataColumnTypes($sql);
    }

    /**
     * Funcion para obtener loas atributos con tipo de dato Interger
     * MODELS_DATA_TYPES_NUMERIC
     * @return String
     */
    public function getModelDataTypesInteger()
    {
        $sql =
        "SELECT
            COLUMN_NAME,
            'Column::TYPE_INTEGER' AS DATA_TYPE
        FROM
            information_schema.columns
        WHERE
            table_name = '$this->tableName'
        AND DATA_TYPE IN ('int' , 'bigint', 'mediumint', 'smallint', 'tinyint');
        ";

        return self::getDataColumnTypes($sql);
    }

    /**
     * Funcion para obtener el tipo de dato para el CAST en la vinculacion de parametros
     * MODELS_DATA_TYPES_BIND
     * @return String
     */
    public function getModelDataTypesBind()
    {
        $sql =
        "SELECT
            COLUMN_NAME,
            CASE
				WHEN DATA_TYPE IN ('int' , 'bigint', 'mediumint', 'smallint', 'tinyint', 'float', 'double', 'decimal') THEN 'Column::BIND_PARAM_INT'
				WHEN DATA_TYPE IN ('date', 'datetime', 'timestamp', 'varchar', 'char', 'text', 'json', 'year', 'mediumtext', 'longtext') THEN 'Column::BIND_PARAM_STR'
                ELSE 'false'
			END AS DATA_TYPE
        FROM
            information_schema.columns
        WHERE
            table_name = '$this->tableName';
        ";

        return self::getDataColumnTypes($sql);
    }

    /**
     * Funcion para obtener los atributos y sus valores preestablecidos
     * MODELS_DEFAULT_VALUES
     * @return String
     */
    public function getModelDataDefaultValues()
    {
        $sql =
        "SELECT
            COLUMN_NAME, COLUMN_DEFAULT AS DATA_TYPE
        FROM
            information_schema.columns
        WHERE
            table_name = '$this->tableName'
                AND COLUMN_DEFAULT IS NOT NULL;
        ";

        return self::getDataColumnTypes($sql, true);
    }

    /**
     * Funcion para obtener los atributos que admiten cadena vacia
     * MODELS_EMPTY_STRING_VALUES
     * @return String
     */
    public function getModelDataEmptyStringValues()
    {
        $sql =
        "SELECT
            COLUMN_NAME, 'true' AS DATA_TYPE
        FROM
            information_schema.columns
        WHERE
            table_name = '$this->tableName'
                AND COLUMN_DEFAULT = '';"
        ;

        return self::getDataColumnTypes($sql);
    }

    /**
     * Funcion que obtiene los atributos a ignorar en los INSERT SQL
     * MODELS_AUTOMATIC_DEFAULT_INSERT
     */
    public function getModelAutomaticDefaultInsert()
    {
        $sql = "SELECT COLUMN_NAME, 'true' AS DATA_TYPE FROM information_schema.columns WHERE table_name = '$this->tableName' AND COLUMN_KEY = 'PRI';";

        return self::getDataColumnTypes($sql);
    }

    /**
     * Funcion para obtener las columnas de la tabla, en base a los condisiones especificadas en el sentencia SQL
     * @param String $sql.
     * @return String $string.
     */
    public static function getDataColumnName($sql)
    {
        $result = mysqli_query(self::$conexion, $sql);
        $string = "\n";
        if ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            do {
                $string .= "\t\t\t\t'" . $row['COLUMN_NAME'] . "',\n";
            } while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC));
        }

        return $string;
    }

    /**
     * Funcion para obtener las columnas y su informacion de la tabla, en base a los condisiones especificadas en el sentencia SQL
     * @param String $sql.
     * @return String $string.
     */
    public static function getDataColumnTypes($sql, $parse = false)
    {
        $result = mysqli_query(self::$conexion, $sql);
        $string = "\n";
        if ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            do {
                $string .= "\t\t\t\t'" . $row['COLUMN_NAME'] . "' => " . ($parse ? (is_numeric($row['DATA_TYPE']) ? $row['DATA_TYPE'] : ("'" . $row['DATA_TYPE'] . "'")) : $row['DATA_TYPE']) . ",\n";
            } while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC));
        }
        return $string;
    }
}
