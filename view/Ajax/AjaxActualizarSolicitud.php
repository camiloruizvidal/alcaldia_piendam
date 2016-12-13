<?php
#=======================================VALIDACION DE SEGURIDAD=======================================#
include_once '../../controller/security_session.php';
validarPost(array("update_fecha_hora", "update_id_estado", "update_documento", "update_nombre", "update_apellido", "update_celular", "update_telefono", "update_correo", "update_id_tipo", "update_id_vereda", "update_descripcion", "update_id_peticion",'files'));
#=======================================VALIDACION DE SEGURIDAD=======================================#
extract($_POST);

include_once '../../controller/controlPetidion.php';
include_once '../../controller/controlFiles.php';
$Peti        = new controlPetidion();
$files       = new controlFiles();
$Peti->ActualizarPeticion($update_id_peticion, $update_id_estado, $update_documento, $update_nombre, $update_apellido, $update_celular, $update_telefono, $update_correo, $update_id_tipo, $update_id_vereda, $update_descripcion);
if (count($_FILES) > 0)
{
    $url = $files->GuardarArchivos($_FILES);
    $files->GuardarArchivoDB($url, $update_id_peticion);
}