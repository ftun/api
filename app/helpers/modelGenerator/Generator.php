<?php

namespace Api\Helper\modelGenerator;

use Api\Helper\modelGenerator\GeneratorModels;

/**
 * Clase para el generardor de codigo
 * @author Felipe Tun <ftun@palaceresorts.com>
 */
class Generator
{
    /**
     * @var String
     * Se almacena el directorio para la creacion del modelo
     */
    public $dirModel;

    /**
     * @var String
     * Se almacena el directorio para la creacion del controlador
     */
    public $dirController;

    /**
     * @var String
     * Se almacena el namespace del model
     */
    public $namespaceModels;

    /**
     * @var String
     * Se almacena el namespace del controllador
     */
    public $namespaceControllers;

    /**
     * @var String
     * Se almacena el nombre del modelo a crear
     */
    public $tableName;

    /**
    * @var array
    * Se alamecna la conexion de la aplicacion phalcon
    */
    public $dbParams = [];

    public function __construct($tableName, $dirModel, $dirController, $dbParams)
    {
        $this->tableName = $tableName;
        $this->dirModel = $this->getDirBaseApp() . $dirModel;
        $this->dirController = $this->getDirBaseApp() . $dirController;
        $this->namespaceModels = str_replace('/', '\\', $dirModel);
        $this->namespaceControllers = str_replace('/', '\\', $dirController);
        $this->dbParams = $dbParams;
    }

    /**
     * Funcion para obtener el directorio base de la aplicacion, considerando que se encuentra en el directorio Helpers esta clase
     */
    public function getDirBaseApp()
    {
        return __DIR__ . '/../..';
    }

    /**
     * Funcion para generar el nombre del archivo y clase del modelo en base al nombre de la tabla
     * @return String
     */
    public function getModelClassName()
    {
        return str_replace(' ', '', ucwords(str_replace('_', ' ', $this->tableName)));
    }

    /**
     * Funcion para generar el nombre del archivo y clase del controlador en base al nombre de la tabla
     * @return String
     */
    public function getControllerClassName()
    {
        return ucwords(str_replace('_', '', substr($this->tableName, strpos($this->tableName, '_') + 1))) . 'Controller';
    }

    /**
     * Funcion para obtener el directorio para la creacion del modelo
     * @return String
     */
    public function getDirModelFile()
    {
        return $this->dirModel . '/' . $this->getModelClassName() . '.php';
    }

    /**
     * Funcion para obtener el directorio para la creacion del controlador
     * @return String
     */
    public function getDirControllerFile()
    {
        return $this->dirController . '/' . $this->getControllerClassName() . '.php';
    }

    /**
     * Funcion para obtener la ruta del archivo y creacion del modelo
     * @return Mixed
     */
    public function getModel()
    {
        return $this->getFile($this->getDirModelFile(), $this->getContentModel());
    }

    /**
     * Funcion para obtener la ruta del archivo y creacion del controlador
     * @return Mixed
     */
    public function getController()
    {
        return $this->getFile($this->getDirControllerFile(), $this->getContentController());
    }

    /**
     * Funcion para generar o actualizar el contenido de un archivo
     * @param String
     */
    public function getFile($file, $content)
    {
        $msn = file_exists($file) ? "El Archivo $file se ha modificado\n" : "El Archivo $file se ha creado\n";
        if ($archivo = fopen($file, "w")) {
            $msn = fwrite($archivo, $content) ? $msn : "Ha habido un problema al crear el archivo\n";
            chmod($file, 0775);
            fclose($archivo);
        }
        return $msn;
    }

    /**
     * Funcion para setear el contenido y remplazar las directivas por los valores reales del modelo mapeado
     * @return String
     */
    public function getContentModel()
    {
        $model = $this->getModelsPhalcon();
        $content = file_get_contents(__DIR__ . '/templateModel.php', true);
        $content = str_replace('@@NAMESPACE', $this->namespaceModels, $content);
        $content = str_replace('@@CLASSNAME', $this->getModelClassName(), $content);
        $content = str_replace('@@TABLESOURCE', $this->tableName, $content);
        $content = str_replace('@@MODELS_ATTRIBUTES', $model->getModelAttributes(), $content);
        $content = str_replace('@@MODELS_PRIMARY_KEY', $model->getModelPrimaryKeys(), $content);
        $content = str_replace('@@MODELS_NON_PRIMARY_KEY', $model->getModelNonPrimaryKeys(), $content);
        $content = str_replace('@@MODELS_NOT_NULL', $model->getModelNotNull(), $content);
        $content = str_replace('@@MODELS_DATA_TYPES_TOTALS', $model->getModelDataTypes(), $content);
        $content = str_replace('@@MODELS_DATA_TYPES_NUMERIC', $model->getModelDataTypesInteger(), $content);
        $content = str_replace('@@MODELS_DATA_TYPES_BIND', $model->getModelDataTypesBind(), $content);
        $content = str_replace('@@MODELS_DEFAULT_VALUES', $model->getModelDataDefaultValues(), $content);
        $content = str_replace('@@MODELS_EMPTY_STRING_VALUES', $model->getModelDataEmptyStringValues(), $content);
        $content = str_replace('@@MODELS_AUTOMATIC_DEFAULT_INSERT', $model->getModelAutomaticDefaultInsert(), $content);
        return $content;
    }

    public function getContentController()
    {
        $modelClass = str_replace("\\", '\\\\', ('Api' . $this->namespaceModels . "\\" . $this->getModelClassName()));
        $content = file_get_contents(__DIR__ . '/templateController.php', true);
        $content = str_replace('@@NAMESPACE', $this->namespaceControllers, $content);
        $content = str_replace('@@USE', $this->namespaceModels, $content);
        $content = str_replace('@@CLASSNAME', $this->getControllerClassName(), $content);
        $content = str_replace('@@MODEL', $this->getModelClassName(), $content);
        $content = str_replace('@@RERERENCIA', $modelClass, $content);
        $content = str_replace('@@IDTABLE', ('id' . $this->tableName), $content);
        return $content;
    }

    /**
     * Funcion para obtener la instancia de la clase que obtiene los parametros para creacion del modelo
     * @return Object.
     */
    public function getModelsPhalcon()
    {
        return new GeneratorModels($this->tableName, $this->dbParams);
    }
}
