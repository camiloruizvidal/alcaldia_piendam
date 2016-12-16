<?php

include_once '../../model/modelFiles.php';

class controlFiles
{

    public function GuardarArchivos($files)
    {

        $dir_subida     = '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . '';
        $fichero_subido = $dir_subida . date('Ymdhis_') . basename($files['files']['name']);
        $bool           = move_uploaded_file($files['files']['tmp_name'], $fichero_subido);
        if ($bool)
        {
            $url_file = str_replace('..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR . '', '.' . DIRECTORY_SEPARATOR . '', $fichero_subido);
            return $url_file;
        }
        else
        {
            return NULL;
        }
    }

    public function GuardarArchivoDB($url, $id_peticion, $tipo_archivo = 'imagen')
    {
        $Files = new modelFiles();
        return $Files->GuardarArchivoDB($url, $id_peticion, $tipo_archivo);
    }

}
