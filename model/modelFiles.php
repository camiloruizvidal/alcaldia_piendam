<?php

include_once 'activerecords/conexion.php';
include_once Config::$home_bin . Config::$ds . 'db' . Config::$ds . 'active_table.php';

class modelFiles
{

    public function GuardarArchivoDB($url, $id_peticion, $tipo_archivo)
    {
        $peticion               = atable::Make('peticion_files');
        $peticion->url          = $url;
        $peticion->tipo_archivo = $tipo_archivo;
        $peticion->id_peticion  = $id_peticion;
        $peticion->Save();
        return $peticion->id_peticion_file;
    }

}
