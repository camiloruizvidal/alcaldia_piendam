<?php

#=======================================VALIDACION DE SEGURIDAD=======================================#
include_once '../../controller/security_session.php';
validarPost(array("documento", "nombre", "apellido", "celular", "telefono", "correo", "id_tipo", "id_vereda", "descripcion"));
#=======================================VALIDACION DE SEGURIDAD=======================================#
extract($_POST);
include_once '../../controller/controlusuario.php';
include_once '../../controller/controlPetidion.php';
include_once '../../controller/controlFiles.php';
$Peti        = new controlPetidion();
$user        = new controlusuario();
$files       = new controlFiles();
$id_usuario  = $user->newusuario($nombre, $apellido, $documento, $telefono, $celular, $correo, $documento, $documento, 3);
$id_peticion = $Peti->newpeticion($id_tipo, $id_usuario, $descripcion, $id_vereda);
$url         = $files->GuardarArchivos($_FILES);
$files->GuardarArchivoDB($url, $id_peticion);
