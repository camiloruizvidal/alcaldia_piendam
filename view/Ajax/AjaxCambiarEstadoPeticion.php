<?php

#=======================================VALIDACION DE SEGURIDAD=======================================#
include_once '../../controller/security_session.php';
validarPost(array('id_peticion', 'id_estado', 'descripcion'));
#=======================================VALIDACION DE SEGURIDAD=======================================#

include_once '../../controller/controlPetidion.php';
$peti = new controlPetidion();
extract($_POST);
$peti->CambioEstadoPeticion($id_peticion, $id_estado, $descripcion);
