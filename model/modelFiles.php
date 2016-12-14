<?php

include_once 'activerecords/conexion.php';
include_once Config::$home_bin . Config::$ds . 'db' . Config::$ds . 'active_table.php';

class modelFiles
{

    private $Log;

    public function __construct()
    {
        include_once '../../controller/controlLog.php';
        $this->Log = new controlLog();
    }

    function GuardarArchivoDB($url, $id_peticion, $tipo_archivo)
    {

        $peticion               = atable::Make('peticion_files');
        $peticion->url          = $url;
        $peticion->tipo_archivo = $tipo_archivo;
        $peticion->id_peticion  = $id_peticion;
        $peticion->Save();
        $this->Log->Insert($peticion->_table, $peticion->_original);
        return $peticion->id_peticion_file;
    }

}
